<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\User;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()

                // User Status Colum
                ->addColumn('status', function ($data) {
                    if ($data->user_status) {
                        $status = '<div class="d-flex"><input type="checkbox" class="userStatus" id="' . $data->id . '" aria-label="Checkbox for following text input" checked="true">&nbsp;<p class="text-success m-0">Active</p>';
                        return $status;
                    } else {
                        $status = '<div class="d-flex"><input type="checkbox" class="userStatus" id="' . $data->id . '" aria-label="Checkbox for following text input">&nbsp;<p class="text-danger m-0">Deactive</p></div>';
                        return $status;
                    }
                })
                
                // Action Colum
                ->addColumn('action', function ($data) {
                    $button = '<div class="row m-1">
                                    <button type="button" id="' . $data->id . '" title="Edit" class="editUser btn btn-success m-1" data-toggle="modal" data-target="#userUpdateModal"><i class="bx bx-edit"></i></button>
                                    <button type="button" id="' . $data->id . '" title="Delete" class="deleteUser btn btn-danger m-1"><i class="bx bx-trash"></i></button>
                                </div>';
                    return $button;
                    
                })
                ->rawColumns(['status' => 'status', 'action' => 'action'])
                ->make(true);
        }
        return view('master');
    }

    // Store User 
    public function addUser(Request $request)
    {
        if ($request->ajax()) {

            // User register form data validator check
            $data = Validator::make($request->all(), [
                'name'             => 'required|string|min:2|max:50',
                'email'            => 'required|string|unique:users,email',
                'password'         => 'required|string',
                'date_of_birth'    => 'required|date',
                'city'             => 'required|string',
                'country'          => 'required',
            ]);

            // This for any input field is missing or not fulfil the requirement.That time,show tost message.
            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()->all()]);
            }


            $user = User::create([
                'name'          => $request->name ,
                'email'         => $request->email ,
                'password'      => Hash::make($request->password),
                'date_of_birth' => $request->date_of_birth ,
                'city'          => $request->city ,
                'country'       => $request->country ,
            ]);

            return response()->json([
                'error'   => false,
                'message' => 'User created Successfully',
            ]);
        }
    }

    // Delete Selected User
    public function deleteUser(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            User::where('id', $data['id'])->delete();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    // Get selected user data
    public function getSelectedUser(Request $request)
    {
        if ($request->ajax()) {
            $user_id = intval($request->user_id);
            $user = User::where('id',$user_id)->first();
            return response()->json($user);
        }
    }

    // Update user data
    public function updateUser(Request $request)
    {
        if ($request->ajax()) {

            // User register form data validator check
            $data = Validator::make($request->all(), [
                'name'             => 'required|string|min:2|max:50',
                'email'            => 'required|string',
                'date_of_birth'    => 'required|date',
                'city'             => 'required|string',
                'country'          => 'required',
            ]);

            // This for any input field is missing or not fulfil the requirement.That time,show tost message.
            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()->all()]);
            }

            $user = User::where('id',$request->user_id)->update([
                'name'          => $request->name ,
                'email'         => $request->email ,
                'date_of_birth' => $request->date_of_birth ,
                'city'          => $request->city ,
                'country'       => $request->country ,
            ]);

            return response()->json([
                'error'   => false,
                'message' => 'User Update Successfully',
            ]);
            
        }
    }

    // Update user status
    public function updateUserStatus(Request $request)
    {
        if ($request->ajax()) {
            $user_id = $request->id;

            $user = User::where('id', $user_id)->first();

            // Check User Current User Status
            if($user->user_status == '1'){
                User::where('id', $user_id)->update([
                    'user_status' => '0',
                ]);
            }else{
                User::where('id', $user_id)->update([
                    'user_status' => '1',
                ]);
            }

            return response()->json([
                'success' => true,
            ]);
        }
    }



}

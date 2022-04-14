<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ALL User</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    {{-- datatables --}}
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    {{-- Icon --}}
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    {{-- sweetalert --}}
    <link rel="stylesheet" href="{{ asset('Front-end/js/sweetalert/sweetalert.min.css') }}" />

   

</head>
<body>

    <div class="container table-responsive py-5"> 
        <h4 class="text-center p-3 m-2">User CRUD</h4>
        <div class="pt-2 pb-2">
            {{-- Button user registration modal --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userRegistrationModal">
                User Registration
            </button>
        </div>
        
        {{-- User  Data Table --}}
        <table class="table table-bordered yajra-datatable" id="userTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>SL.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Date of birth</th>
              <th>City</th>
              <th>Country</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
    </div>
        

    {{-- User Register Modal --}}
    <div class="modal fade" id="userRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="userRegistrationModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">User Registration Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {{-- User Registration Form --}}
                <form class="user_registration_form" action="{{ url('add-user') }}" method="POST" >
                  @csrf
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input type="text" class="form-control" id="name" name="name"> 
                    </div>

                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" class="password_toogle" aria-label="Checkbox for following text input"> &nbsp;Show Password
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                    </div>

                    <div class="row form-group">

                        <div class="col">
                            <label for="city">User City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>

                        <div class="col">
                            <label for="country">User Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>

                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
                {{-- End:User Registration Form --}}
            </div>
          </div>
        </div>
    </div>
    {{-- End:User Register Modal --}}


    {{-- Update User Modal --}}
    <div class="modal fade" id="userUpdateModal" tabindex="-1" role="dialog" aria-labelledby="userUpdateModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">User Update Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {{-- User Update Form --}}
                <form class="user_update_form" id="user_update_form" action="{{ url('update-user') }}" method="POST" >
                    @csrf

                    <input type="hidden" id="user_id" name="user_id">

                    <div class="form-group">
                        <label for="name">User name</label>
                        <input type="text" class="form-control" id="name" name="name"> 
                    </div>

                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                    </div>

                    <div class="row form-group">

                        <div class="col">
                            <label for="city">User City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>

                        <div class="col">
                            <label for="country">User Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>

                    </div>
                    
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
                {{-- End:User Registration Form --}}
            </div>
          </div>
        </div>
    </div>
    {{-- End:User Register Modal --}}
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    
    {{-- iziToast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    {{-- dataTables --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('Front-end/js/sweetalert/sweetalert.js') }}" type="text/javascript" ></script>


    <script type="text/javascript">
        
        // csrf token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // User Register Form Password Show or hidden
        $(".password_toogle").click(function (e){
            e.preventDefault();//prevent default action
            var pass = document.getElementById("password"); // get input id and store in variable 
            if (pass.type === "password") {
              pass.type = "text";
            } else {
              pass.type = "password";
            }
        })


        // Register User
        $(".user_registration_form").submit(function(event) {
            event.preventDefault(); //prevent default action
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission
            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data,
                success: function(resp) {
                    if (resp.error === false) {
                        // clear form input field data
                        $(".user_registration_form").trigger("clear");
                        // show toast message
                        iziToast.show({
                            title: "Success!",
                            position: "topRight",
                            timeout: 4000,
                            color: "green",
                            message: resp.message,
                            messageColor: "black"
                        });
                    } else if (resp.errors) {
                        iziToast.show({
                            title: "Oopps!",
                            position: "topRight",
                            timeout: 4000,
                            color: "red",
                            message: resp.errors[0],
                            messageColor: "black"
                        });
                    } else {
                        iziToast.show({
                            title: "Oopps!",
                            position: "topRight",
                            timeout: 4000,
                            color: "red",
                            message: resp.message,
                            messageColor: "black"
                        });
                    }
                },
                error: function() {
                    console.log("Error");
                }
            });

            // Close Modal After Process Complete
            jQuery.noConflict();
            $("#userRegistrationModal").modal('hide');
        });


        // Show All User Data In Table
        $("#userTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/"
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false
                },
                { data: "name", name: "name" },
                { data: "email",name: "email"},
                { data: "date_of_birth",name: "date_of_birth"},
                { data: "city",name: "city"},
                { data: "country",name: "country"},
                { data: "status",name: "status"},
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // delete User
        $(document).on("click", ".deleteUser", function(e) {
            e.preventDefault();
            var id = $(this).attr("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "/delete-user",
                        data: { id: id },
                        success: function(resp) {
                            if (resp.success === true) {
                                // reload table data
                                $("#countryTable")
                                    .DataTable()
                                    .ajax.reload();
                                // show success message toast
                                iziToast.show({
                                    title: "Success!",
                                    position: "topRight",
                                    timeout: 3000,
                                    color: "green",
                                    message: "User Deleted Successfully.",
                                    messageColor: "black"
                                });
                            } else {
                                // show error message
                                iziToast.show({
                                    title: "Opppps!",
                                    position: "topRight",
                                    timeout: 2000,
                                    color: "red",
                                    message: "Something Wrong. Please try again.",
                                    messageColor: "black"
                                });
                            }
                        },
                        error: function() {
                            console.log("Error");
                        }
                    });
                }
            });
        });


        // Get Selected User Data
        $(document).on("click", ".editUser", function(e) {
            e.preventDefault();
            var user_id = $(this).attr("id");    
            $.ajax({
                type: "GET",
                url: "/selected-user",
                data: { user_id: user_id },
                success: function(resp) {  
                    $("#user_update_form #user_id").val(resp.id);
                    $("#user_update_form #name").val(resp.name);
                    $("#user_update_form #email").val(resp.email);
                    $("#user_update_form #date_of_birth").val(resp.date_of_birth);
                    $("#user_update_form #city").val(resp.city);
                    $("#user_update_form #country").val(resp.country);
                },
                error: function() {
                    console.log("Error");
                }
            });  
        });

        // Update User Data
        $(".user_update_form").submit(function(event) {
            event.preventDefault(); //prevent default action
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission
            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data,
                success: function(resp) {
                    if (resp.error === false) {
                        // clear form input field data
                        $(".user_update_form").trigger("clear");
                        // show toast message
                        iziToast.show({
                            title: "Success!",
                            position: "topRight",
                            timeout: 4000,
                            color: "green",
                            message: resp.message,
                            messageColor: "black"
                        });
                    } else if (resp.errors) {
                        iziToast.show({
                            title: "Oopps!",
                            position: "topRight",
                            timeout: 4000,
                            color: "red",
                            message: resp.errors[0],
                            messageColor: "black"
                        });
                    } else {
                        iziToast.show({
                            title: "Oopps!",
                            position: "topRight",
                            timeout: 4000,
                            color: "red",
                            message: resp.message,
                            messageColor: "black"
                        });
                    }
                },
                error: function() {
                    console.log("Error");
                }
            });

            // Close Modal After Process Complete
            jQuery.noConflict();
            $("#userUpdateModal").modal('hide');
        });



        $(document).on("click", ".userStatus", function(e) {
            e.preventDefault();
            var id = $(this).attr("id");

            $.ajax({
                type: "post",
                url: "/update-status",
                data: { id: id },
                success: function(resp) {
                    if (resp.success === true) {
                        // reload table data
                        $("#countryTable")
                            .DataTable()
                            .ajax.reload();
                            // show success message toast
                            iziToast.show({
                                title: "Success!",
                                position: "topRight",
                                timeout: 3000,
                                color: "green",
                                message: "User Deleted Successfully.",
                                messageColor: "black"
                             });
                    } else {
                        // show error message
                        iziToast.show({
                            title: "Opppps!",
                            position: "topRight",
                            timeout: 2000,
                            color: "red",
                            message: "Something Wrong. Please try again.",
                            messageColor: "black"
                        });
                    }
                },
                error: function() {
                    console.log("Error");
                }
            });

        })







    </script>
 
</body>
</html>
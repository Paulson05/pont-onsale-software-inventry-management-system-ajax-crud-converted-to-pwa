@extends('backend.template.defaults')
@section('title', '| dashboard')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-primary">
                                        <i class="now-ui-icons ui-2_chat-round"></i>
                                    </div>
                                    <h3 class="info-title">{{\App\Models\Customer::count()}}</h3>
                                    <h6 class="stats-title">Customer</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-success">
                                        <i class="now-ui-icons business_money-coins"></i>
                                    </div>
                                    <h3 class="info-title">{{\App\Models\Supplier::count()}}</h3>
                                    <h6 class="stats-title">Supplier</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-info">
                                        <i class="now-ui-icons users_single-02"></i>
                                    </div>
                                    <h3 class="info-title">{{\App\Models\Category::count()}}</h3>
                                    <h6 class="stats-title">Category</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-danger">
                                        <i class="now-ui-icons objects_support-17"></i>
                                    </div>
                                    <h3 class="info-title">{{\App\Models\Product::count()}}</h3>
                                    <h6 class="stats-title">Product</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">



            <div class="row">

                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">+</button>
                    {{--                    <div  class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                    <div  class="modal  fade pt-5" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Creat New User</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <ul id="saveform_errList"></ul>




                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>User name</strong>
                                                <input type="text" name="name"  id="name" class="name form-control" placeholder="supplier name" >

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>password</strong>
                                                <input type="password" name="password" id="password" class="password form-control" placeholder="password" >

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>Email</strong>
                                                <input type="text" name="email" class="email form-control" placeholder="email">

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>Phone Number</strong>
                                                <input type="number" name="phone_number" class="phone_number form-control" placeholder="+34933223" >

                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <button type="submit" class="add_user btn btn-primary">Save</button>
                                        </div>
                                    </div>




                                </div>

                            </div>




                        </div>

                    </div>

                </div>
                <div class="col-md-12 table-responsive card">
                    <div class="data-tables">
                        <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="fresh-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">

                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th>Permission</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-link btn-info like"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="btn btn-link btn-warning edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-link btn-danger remove"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            fetchUser();
            function fetchUser() {
                $.ajax({
                    type: "GET",
                    url:"/fetchuser",
                    dataType:"json",
                    success: function (response) {
                        // console.log(response.posts);

                        $('tbody').html("");
                        $.each(response.users, function (key, item) {
                            $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                           <td>'+item.email+'</td>\
                                           <td>'+item.phone_number+'</td>\
                                           <td>'+item.address+'</td>\
                                           <td>'+item.phone_number+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_btn btn btn-primary" ><i class="fa fa-edit"></i></button></td>\
                                              <td><button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash"></i></button></td>\
                                            </tr>');
                        });
                    }
                })
            }

            {{--delete--}}
            $(document).on('click', '.delete_post', function (e){
                e.preventDefault();

                var post_id  = $(this).val();
                // alert(post_id);

                $('#delete_post_id').val(post_id);

                $('#example2Modal').modal("show");

            });
            $(document).on('click', '.delete_post_btn', function (e){
                e.preventDefault();


                var post_id  = $('#delete_post_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url:"/delete-supplier/"+post_id,
                    success: function (response){
                        // console.log(response);
                        $('#success_message').addClass("alert  alert_success");
                        $('#success_message').text(response.message);
                        $('#example2Modal').modal("hide");
                        $('.delete_post_btn').text("yes Delete");
                        fetchUser();
                        swal.fire(
                            'congratulation!',
                            'user deleted successfully',
                            'success'
                        )
                    }

                });

            });

            {{--edit--}}
            $(document).on('click', '.edit_btn', function (e){
                e.preventDefault();
                let post_id  = $(this).val();
                // console.log(post_id);
                $('#editModal').modal("show");
                $.ajax({
                    type: "GET",
                    url:"/edit-supplier/"+post_id,

                    success: function (response) {
                        console.log(response);
                        if (response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);

                        }
                        else{
                            $("#edit_name").val(response.supplier.name);
                            $("#edit_mobile_no").val(response.supplier.mobile_no);
                            $("#address").val(response.supplier.address);
                            $("#email").val(response.supplier.email);
                            $("#edit_post_id").val(post_id);


                        }

                    }
                });


            });
            {{--update--}}
            $(document).on('click', '.update_supplier', function (e){
                e.preventDefault();

                let post_id  = $('#edit_post_id').val();
                var data = {
                    'name' : $('#edit_name').val(),
                    'address' : $('#address').val(),
                    'mobile_no' : $('#edit_mobile_no').val(),
                    'email' : $('#email').val(),


                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url:"/update-product/"+post_id,
                    data:data,
                    dataType:"json",


                    success: function (response){
                        // console.log(response);
                        if (response.status == 400)
                        {
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass("alert  alert-danger");
                            $.each(response.errors, function (key, err_value) {
                                $('#updateform_errList').append('<li>'+err_value+'</li>');
                            })
                        }
                        else{
                            $('#updateform_errList').html("");
                            $('#success_message').addClass("alert  alert-success");
                            $('#success_message').text(response.message);
                            $('#editModal').modal("hide");
                            fetchUser();
                        }

                    }
                });

            });


            {{--add post--}}


            $(document).on('click', '.add_user', function (e){
                e.preventDefault();
                // console.log('click');
                var data = {
                    'name' : $('.name').val(),
                    'email' : $('.email').val(),
                    'password' : $('.password').val(),
                    'phone_number' : $('.phone_number').val(),

                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/postRegister/",
                    data:data,
                    dataType:"json",

                    success: function (response){
                        // console.log(response);
                        if (response.status == 400)
                        {
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass("alert  alert-danger");
                            $.each(response.errors, function (key, err_value) {
                                $('#saveform_errList').append('<li>'+err_value+'</li>');
                            })
                        }
                        else{
                            $('#saveform_errList').html("");
                            $('#success_message').addClass("alert  alert-success");
                            $('#success_message').text(response.message);
                            $('#exampleModalLabel').modal("hide");
                            $('#addModal').find("input").val("");
                            fetchUser();
                            swal.fire(
                                'congratulation!',
                                'user added successfully',
                                'success'
                            )
                        }

                    }
                })
            });


        });
    </script>
@endsection

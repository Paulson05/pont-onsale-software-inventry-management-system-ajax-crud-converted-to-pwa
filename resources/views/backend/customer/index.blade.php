@extends('backend.template.defaults')
@section('title', '| customer')
@section('body')
    <div class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Customer::count()}})</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">+</button>
                    <div  class="modal  fade pt-5" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Creat customer</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>




                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>Customer name</strong>
                                                <input type="text" name="name"  id="name" class="name form-control" placeholder="supplier name" >

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>phone number</strong>
                                                <input type="number" name="mobile_no" id="mobile_no" class="mobile_no form-control" placeholder="phone number" >

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
                                                <strong>Address</strong>
                                                <input type="text" name="address" class="address form-control" placeholder="address" >

                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <button type="submit" class="add_customer btn btn-primary">Save</button>
                                        </div>
                                    </div>




                                </div>

                            </div>




                        </div>

                    </div>

                </div>
                <div class="col-md-12">
                    <div class="card data-tables">
                        <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="fresh-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Phone number</th>
                                        <th>Email</th>
                                        <th>Adrress</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button type="button"   class="edit_customer btn btn-primary" ><i class="fa fa-edit"></i></button></td>
                                        <td><button type="button"   class="delete_post btn btn-primary" ><i class="fa fa-trash"></i></button></td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--edit modal --}}
        <div  class="modal  fade pt-5" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">EDIT    Customer</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <ul id="saveform_errList"></ul>




                        <div class="row">
                            <input type="hidden" id="edit_post_id">
                            <input type="hidden" id="edit_post_id">
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>Customer name</strong>
                                    <input type="text" name="name"  id="edit_name" class="name form-control" placeholder="supplier name" >

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>phone number</strong>
                                    <input type="number" name="mobile_no" id="edit_mobile_no" class="mobile_no form-control" placeholder="phone number" >

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>Email</strong>
                                    <input type="text" name="email" id="edit_email" class="email form-control" placeholder="email">

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>Address</strong>
                                    <input type="text" name="address" id="edit_address" class="address form-control" placeholder="address" >

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <button type="submit" class="update_customer btn btn-primary">update</button>
                            </div>
                        </div>




                    </div>

                </div>




            </div>
        </div>

        {{--delete modal--}}
        <div  class="modal  fade pt-5" id="example2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-small">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Post</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <input type="hidden" id="delete_post_id">

                        <h4>are you sure want to delete this data</h4>
                    </div>

                    <div class="modal-footer tex">
                        <button type="submit" class="add_post btn btn-outline-secondary" data-dismiss="modal">close</button>
                        <button type="submit" class="delete_post_btn btn btn-primary delete_post_btn">yes delete</button>

                    </div>



                </div>




            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            fetchcustomer();
            function  fetchcustomer() {
                $.ajax({
                    type: "GET",
                    url:"/fetchcustomer/",
                    dataType:"json",
                    success: function (response) {
                        // console.log(response.posts);

                        $('tbody').html("");
                        $.each(response.customers, function (key, item){
                            $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                           <td>'+item.mobile_no+'</td>\
                                           <td>'+item.email+'</td>\
                                           <td>'+item.address+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_customer btn btn-primary" ><i class="fas fa-edit">edit</i></button></td>\
                                              <td><button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash">delete</i></button></td>\
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
                    url:"/delete-customer/"+post_id,
                    success: function (response){
                        // console.log(response);
                        $('#success_message').addClass("alert  alert_success");
                        $('#success_message').text("response.message");
                        $('#example2Modal').modal("hide");
                        $('.delete_post_btn').text("yes Delete");
                        fetchcustomer();
                        swal.fire(
                            'congratulation!',
                            'customer deleted successfully',
                            'success'
                        )
                    }

                });

            });

            {{--edit--}}
            $(document).on('click', '.edit_customer', function (e){
                e.preventDefault();
                let post_id  = $(this).val();
                // console.log(post_id);
                $('#editModal').modal("show");
                $.ajax({
                    type: "GET",
                    url:"/edit-customer/"+post_id,

                    success: function (response) {
                        console.log(response);
                        if (response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);

                        }
                        else{
                            $("#edit_name").val(response.customer.name);
                            $("#edit_mobile_no").val(response.customer.mobile_no);
                            $("#edit_email").val(response.customer.email);
                            $("#edit_address").val(response.customer.address);
                            $("#edit_post_id").val(post_id);
                        }

                    }
                });


            });
            {{--update--}}
            $(document).on('click', '.update_customer', function (e){
                e.preventDefault();

                let post_id  = $('#edit_post_id').val();
                var data = {
                    'name' : $('#edit_name').val(),
                    'email' : $('#edit_email').val(),
                    'address' : $('#edit_address').val(),
                    'mobile_no' : $('#edit_mobile_no').val(),


                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url:"/update-customer/"+post_id,
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
                            fetchcustomer();
                            swal.fire(
                                'congratulation!',
                                'customer updated successfully',
                                'success'
                            )
                        }

                    }
                });

            });


            {{--add post--}}


            $(document).on('click', '.add_customer', function (e){
                e.preventDefault();
                // console.log('click');
                var data = {
                    'name' : $('.name').val(),
                    'mobile_no' : $('.mobile_no').val(),
                    'email' : $('.email').val(),
                    'address' : $('.address').val(),
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/post-customer/",
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
                            $('#addModal').modal("hide");
                            $('#addModal').find("input").val("");
                            fetchcustomer();
                            swal.fire(
                                'congratulation!',
                                'customer added successfully',
                                'success'
                            )
                        }

                    }
                })
            });


        });
    </script>
@endsection


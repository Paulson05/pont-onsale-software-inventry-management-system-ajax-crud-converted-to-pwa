@extends('backend.template.defaults')
@section('title', '| supplier')
@section('body')
    <div class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Supplier::count()}})</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">+</button>
{{--                    <div  class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                    <div  class="modal  fade pt-5" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Creat supplier</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <ul id="saveform_errList"></ul>




                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>Supllier name</strong>
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
                                            <button type="submit" class="add_product btn btn-primary">Save</button>
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
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
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
        {{--edit modal --}}
        <div  class="modal  fade pt-5" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">EDIT supplier</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <ul id="saveform_errList"></ul>
                        <div id="success_message"></div>



                        <div class="row">
                            <input type="hidden" id="edit_post_id">
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>Supllier name</strong>
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
                                    <input type="text" name="email" id="email" class="email form-control" placeholder="email">

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <div class="form-group">
                                    <strong>Address</strong>
                                    <input type="text" name="address" id="address" class="address form-control" placeholder="address" >

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <button type="submit" class="update_supplier btn btn-primary">update</button>
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
            fetchSupplier();
            function fetchSupplier() {
                $.ajax({
                    type: "GET",
                    url:"/fetchsupplier",
                    dataType:"json",
                    success: function (response) {
                        // console.log(response.posts);

                        $('tbody').html("");
                        $.each(response.suppliers, function (key, item){
                            $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                           <td>'+item.mobile_no+'</td>\
                                           <td>'+item.email+'</td>\
                                           <td>'+item.address+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_btn btn btn-primary" ><i class="fas fa-edit"> edit</i></button></td>\
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
                    url:"/delete-supplier/"+post_id,
                    success: function (response){
                        // console.log(response);
                        $('#success_message').addClass("alert  alert_success");
                        $('#success_message').text(response.message);
                        $('#example2Modal').modal("hide");
                        $('.delete_post_btn').text("yes Delete");
                        fetchSupplier();
                        swal.fire(
                            'congratulation!',
                            'supllier deleted successfully',
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
                            fetchSupplier();
                        }

                    }
                });

            });


            {{--add post--}}


            $(document).on('click', '.add_product', function (e){
                e.preventDefault();
                // console.log('click');
                var data = {
                    'name' : $('.name').val(),
                    'mobile_no' : $('.mobile_no').val(),
                    'email' : $('.email').val(),
                    'address' : $('.address').val(),

                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/post-supplier/",
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
                            fetchSupplier();
                            swal.fire(
                                'congratulation!',
                                'supllier updated successfully',
                                'success'
                            )
                        }

                    }
                })
            });


        });
    </script>
@endsection


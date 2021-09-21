@extends('backend.template.defaults')
@section('title', '| permission')
@section('body')
    <div class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Permission</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Unit::count()}})</li>
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
                                    <h4 class="modal-title">Creat Permission</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">





                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <div class="form-group">
                                                <strong>permission name</strong>
                                                <input type="text" name="name"  id="name" class="name form-control" placeholder="permission name" >

                                            </div>

                                        </div>



                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <button type="submit" class="add_unit btn btn-primary">Save</button>
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
                                           <th>S/N</th>
                                           <th>Name</th>
                                           <th>Slug</th>
                                           <th>Action</th>
                                       </tr>
                                       </thead>

                                       <tbody>
                                       <tr>
                                           <td></td>
                                           <td></td>
                                           <td>
                                               <button type="button"   class="edit_unit btn btn-primary" ><i class="fa fa-edit"></i></button>
                                               <button type="button"   class="delete_post btn btn-primary" ><i class="fa fa-trash"></i></button>
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
                        <h4 class="modal-title">Update unit</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>




                        <div class="row">
                            <input type="hidden" id="edit_post_id">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <div class="form-group">
                                    <strong>Role name</strong>
                                    <input type="text" name="name"  id="edit_name" class="name form-control" placeholder="supplier name" >

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <button type="submit" class="update_unit btn btn-primary">Update</button>
                            </div>
                        </div>




                    </div>

                </div>




            </div>
        </div>

        {{--delete modal--}}
        <div  class="modal  fade pt-5" id="example2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-sm">
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
            fetchrole();
            function  fetchrole() {
                $.ajax({
                    type: "GET",
                    url:"/fetch-role/",
                    dataType:"json",
                    success: function (response) {
                        // console.log(response.posts);

                        $('tbody').html("");
                        $.each(response.roles, function (key, item){
                            $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                           <td>'+item.slug+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_unit btn btn-primary" ><i class="fa fa-edit"></i></button>\
                                            <button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash"></i></button></td>\
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
                    url:"/delete-role/"+post_id,
                    success: function (response){
                        // console.log(response);
                        $('#success_message').addClass("alert  alert_success");
                        $('#success_message').text("response.message");
                        $('#example2Modal').modal("hide");
                        $('.delete_post_btn').text("yes Delete");
                        fetchrole();
                        swal.fire(
                            'congratulation!',
                            'role deleted successfully',
                            'success'
                        )
                    }

                });

            });

            {{--edit--}}
            $(document).on('click', '.edit_unit', function (e){
                e.preventDefault();
                let post_id  = $(this).val();
                // console.log(post_id);
                $('#editModal').modal("show");
                $.ajax({
                    type: "GET",
                    url:"/edit-role/"+post_id,

                    success: function (response) {
                        console.log(response);
                        if (response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);

                        }
                        else{

                            $("#edit_name").val(response.role.name);
                            $("#edit_post_id").val(post_id);
                        }

                    }
                });


            });
            {{--update--}}
            $(document).on('click', '.update_unit', function (e){
                e.preventDefault();

                let post_id  = $('#edit_post_id').val();
                var data = {

                    'name' : $('#edit_name').val(),


                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url:"/update-role/"+post_id,
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
                            fetchrole();
                             swal.fire(
                                 'congratulation!',
                                 'edit updated successfully',
                                 'success'
                             )
                        }

                    }
                });

            });


            {{--add post--}}


            $(document).on('click', '.add_unit', function (e){
                e.preventDefault();
                console.log('click');
                var data = {
                    'name' : $('.name').val(),


                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/post-permission/",
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
                            fetchrole();
                            swal.fire(
                                'congratulation!',
                                'permission added successfully',
                                'success'
                            )
                        }

                    }
                })
            });


        });
    </script>
@endsection


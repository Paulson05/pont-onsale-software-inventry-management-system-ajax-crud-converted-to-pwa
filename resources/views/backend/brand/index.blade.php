@extends('backend.template.defaults')
@section('title', '| brand ')
@section('body')
<div class="content">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Brand</a></li>
                <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Brand::count()}})</li>
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
                                <h4 class="modal-title">Creat Brand</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>


                                      <form id="LoginValidation"  method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
                                        @csrf
                                          <div class="row">


                                              <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                                  <div class="form-group has-label">
                                                      <strong>Brand name</strong>
                                                      <input type="text" name="name"  id="name" class="name form-control"  placeholder="brand name" value = "{{Request::old('name') ?: ''}}" required="true">
                                                  </div>

                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12">

                                                   <input type="file" name="image" class="image form-control" placeholder="upload">

                                                  </div>

                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                                  <button type="submit" id="submit" class="add_unit btn btn-primary">Save</button>
                                              </div>
                                          </div>
                                      </form>

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
                                    <th>name</th>

                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><button type="button"   class="edit_unit btn btn-primary" ><i class="fa fa-edit"></i></button></td>
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
                    <h4 class="modal-title">Update Brand</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>



                 <form id="submit">
                     <div class="row">
                         <input type="hidden" id="edit_post_id">
                         <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                             <div class="form-group">
                                 <strong>unit name</strong>
                                 <input type="text" name="name"  id="edit_name" class="name form-control" placeholder="supplier name" >

                             </div>

                         </div>

                         <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                             <button type="submit" class="update_unit btn btn-primary">Update</button>
                         </div>
                     </div>
                 </form>





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
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="{{asset('/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.12/jquery.validate.unobtrusive.min.js" integrity="sha512-o6XqxgrUsKmchwy9G5VRNWSSxTS4Urr4loO6/0hYdpWmFUfHqGzawGxeQGMDqYzxjY9sbktPbNlkIQJWagVZQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    <script>
        function setFormValidation(id){
        $(id).validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement : function(error, element) {
                $(element).append(error);
            },
        });
    }

        $(document).ready(function() {
        setFormValidation('#RegisterValidation');
        setFormValidation('#TypeValidation');
        setFormValidation('#LoginValidation');
        setFormValidation('#RangeValidation');
    });
</script>
</script>
<script>
    $(document).ready(function () {
        fetchunit();
        function  fetchunit() {
            $.ajax({
                type: "GET",
                url:"/fetch-unit/",
                dataType:"json",
                success: function (response) {
                    // console.log(response.posts);

                    $('tbody').html("");
                    $.each(response.units, function (key, item){
                        $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_unit btn btn-primary" ><i class="fa fa-edit">edit</i></button></td>\
                                              <td><button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash">delete</i></button></td>\
                                            </tr>');
                    });
                }
            })
        }


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
                url:"/delete-unit/"+post_id,
                success: function (response){
                    // console.log(response);
                    $('#success_message').addClass("alert  alert_success");
                    $('#success_message').text("response.message");
                    $('#example2Modal').modal("hide");
                    $('.delete_post_btn').text("yes Delete");
                    fetchunit();
                    swal.fire(
                        'congratulation!',
                        'uni deleted successfully',
                        'success'
                    )
                }

            });

        });


        $(document).on('click', '.edit_unit', function (e){
            e.preventDefault();
            let post_id  = $(this).val();
            // console.log(post_id);
            $('#editModal').modal("show");
            $.ajax({
                type: "GET",
                url:"/edit-unit/"+post_id,

                success: function (response) {
                    console.log(response);
                    if (response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);

                    }
                    else{

                        $("#edit_name").val(response.unit.name);
                        $("#edit_post_id").val(post_id);
                    }

                }
            });


        });

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
                url:"/update-unit/"+post_id,
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
                        fetchunit();
                        swal.fire(
                            'congratulation!',
                            'brand updated successfully',
                            'success'
                        )
                    }

                }
            });

        });





        $(document).on('click', '.add_unit', function (e){
            e.preventDefault();
            // console.log('click');
            var data = {
                'name' : $('.name').val(),
                'image' : $('.image').val(),
            }
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url:"{{route('brand.store')}}",
                data:data,
                dataType:"json",
                datType: "image/jpeg",

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
                        $('#saveform_errList').html("");
                        $('#addModal').find("input").val("");
                        fetchunit();
                        swal.fire(
                            'congratulation!',
                            'brand added successfully',
                            'success'
                        )
                    }

                }
            })
        });


    });
</script>
@endsection


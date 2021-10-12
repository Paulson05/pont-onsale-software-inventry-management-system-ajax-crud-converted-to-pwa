@extends('backend.template.defaults')
@section('title', '| product')
@section('body')
    <div class="content">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Product::count()}})</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">+</button>
                    {{--add modal--}}
                    <div  class="modal  fade pt-5" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Creat product</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>




                                    <div class="row">


                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left ">
                                            <div class="form-group">
                                                <strong>Product name</strong>
                                                <input type="text" name="name"   id="name" class="name form-control " placeholder="supplier name" >

                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left ">
                                            <div class="form-group">
                                                <strong>alert stock</strong>
                                                <input type="text" name="alert_stock"   id="alert_stock" class="alert_stock form-control " placeholder="alert_stock" >

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left ">
                                            <div class="form-group">
                                                <strong>photo</strong>
                                                <input type="file" name="photo"   id="alert_stock" class="fileform-control " placeholder="photo" >

                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                <strong>Category</strong>
                                                @php
                                                    $categories = \App\Models\Category::all();
                                                @endphp
                                                <select name="categories_id" id="category_id" class="category_id form-control" data-title="Single Category" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

                                                    <option>--select category--</option>

                                                    @forelse($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @empty


                                                        <option value="id">no category</option>

                                                    @endforelse
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                            <div class="form-group">
                                                @php
                                                    $units = \App\Models\Unit::all();
                                                @endphp
                                                <strong>Unit</strong>
                                                <select name="unit_id" id="unit_id" class="form-control" data-title="Single Unit" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

                                                    <option>--select unit--</option>

                                                    @forelse($units as $unit)
                                                        <option value="{{{$unit->id}}}">{{$unit->name}}</option>
                                                    @empty
                                                        <option value="">no unit</option>

                                                    @endforelse
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <div class="form-group">
                                                @php
                                                    $suppliers = \App\Models\Supplier::all();
                                                @endphp
                                                <strong>Supplier</strong>
                                                <select name="suppliers_id" id="suppliers_id" class="suppliers_id form-control" data-title="Single Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">
                                                    <option>--select supplier--</option>
                                                    @forelse($suppliers as $supplier)

                                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                    @empty
                                                        <option value="is">no supplier</option>

                                                    @endforelse
                                                </select>

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
                {{--edit modal --}}
                <div  class="modal  fade pt-5" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>
                                <div class="text-center" id="success_message"></div>



                                <div class="row">
                                    <input type="hidden" id="edit_post_id">

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <div class="form-group">
                                            <strong>product name</strong>
                                            <input type="text" name="name"  id="edit_name" class="name form-control" placeholder="supplier name" >

                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <div class="form-group">
                                            <strong>category name</strong>
                                            <input type="text" name="categories_id"  id="edit_categories_id" class="name form-control" placeholder="supplier name" >

                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <div class="form-group">
                                            <strong>unit name</strong>
                                            <input type="text" name="units_id"  id="edit_units_id" class="name form-control" placeholder="supplier name" >

                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <div class="form-group">
                                            <strong>supplier name</strong>
                                            <input type="text" name="suppliers_id"  id="edit_suppliers_id" class="name form-control" placeholder="supplier name" >

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <button type="submit" class="update_product btn btn-primary">Update</button>
                                    </div>
                                </div>




                            </div>

                        </div>




                    </div>
                </div>
                {{--delete modal--}}
                <div  class="modal  fade pt-5" id="example2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-small text-center">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header ">
                                <h4 class="modal-title text-center">Delete product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <input type="hidden" id="delete_post_id">

                                <h4>are you sure want to delete this data</h4>
                            </div>

                            <div class="modal-footer tex">
                                <button type="submit" class="add_post btn btn-outline-secondary" data-dismiss="modal">close</button>
                                <button type="submit" class="delete_post_btn btn btn-danger delete_post_btn">yes delete</button>

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
                                        <th>NAME</th>
                                        <th>Supplier</th>
                                        <th>Unit</th>
                                        <th>alert stock</th>
                                        <th>Category</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->supplier->name}}</td>
                                            <td>{{$product->unit->name}}</td>
                                            <td>{{$product->category->name}}</td>

                                            {{--                                        <td>{{$product->first()->name}}</td>--}}

                                            <td>
                                                <button type="button"   class="delete_post btn btn-primary" ><i class="fa fa-trash">delete</i></button>

                                                <button type="button"   class="edit_product btn btn-primary" ><i class="fa fa-edit">edit</i></button>
                                            <td>

                                        </tr>
                                    @endforeach
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
            fetchproduct();
            function  fetchproduct() {
                $.ajax({
                    type: "GET",
                    url:"/fetch-product/",
                    dataType:"json",
                    success: function (response) {
                        // console.log(response.posts);

                        $('tbody').html("");
                        $.each(response.products, function (key, item){
                            $('tbody').append('<tr>\
                                            <td>'+item.id+'</td>\
                                           <td>'+item.name+'</td>\
                                           <td>'+item.suppliers_id+'</td>\
                                           <td>'+item.unit_id+'</td>\
                                            <td>'+item.alert_stock+'</td>\
                                           <td>'+item.category_id+'</td>\
                                            <td><button type="button"  value="'+item.id+'" class="edit_product btn btn-primary" ><i class="fa fa-edit">edit</i></button></td>\
                                              <td><button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash">delete</i></button></td>\
                                            </tr>');
                        });
                    }
                })
            }
            $(document).on('click', '.add_product', function (e){
                e.preventDefault();
                // console.log('click');
                var data = {
                    'name' : $('.name').val(),
                    'photo' : $('.photo').val(),
                    'suppliers_id' : $('#suppliers_id').val(),
                    'unit_id' : $('#unit_id').val(),
                    'alert_stock' : $('#alert_stock').val(),
                    'category_id' : $('#category_id').val(),
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/post-product/",
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
                            fetchproduct();
                            swal.fire(
                                'congratulation!',
                                'product added successfully',
                                'success'
                            )
                        }

                    }
                })
            });


            $(document).on('click', '.delete_post', function (e){
                e.preventDefault();

                var post_id  = $(this).val();


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
                    url:"/delete-product/"+post_id,
                    success: function (response){
                        // console.log(response);
                        $('#success_message').addClass("alert  alert_success");
                        $('#success_message').text(response.message);
                        $('#example2Modal').modal("hide");
                        $('.delete_post_btn').text("yes Delete");
                        fetchproduct();
                        swal.fire(
                            'congratulation!',
                            'product deleted successfully',
                            'success'
                        )
                    }

                });

            });

            $(document).on('click', '.edit_product', function (e){
                e.preventDefault();
                let post_id  = $(this).val();
                // console.log(post_id);
                $('#editModal').modal("show");
                $.ajax({
                    type: "GET",
                    url:"/edit-product/"+post_id,

                    success: function (response) {
                        console.log(response);
                        if (response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);

                        }
                        else{
                            $("#edit_name").val(response.product.name);
                            $("#edit_category_id").val(response.product.category_id);
                            $("#edit_unit_id").val(response.product.unit_id);
                            $("#edit_suppliers_id").val(response.product.suppliers_id);
                            $("#edit_post_id").val(post_id);
                        }

                    }
                });


            });

            $(document).on('click', '.update_product', function (e){
                e.preventDefault();

                let post_id  = $('#edit_post_id').val();
                var data = {
                    'title' : $('#edit_title').val(),
                    'slug' : $('#edit_slug').val(),
                    'tag' : $('#edit_tag').val(),
                    'image' : $('#image').val(),
                    'category_id' : $('#edit_category_id').val(),
                    'body' : $('#edit_body').val(),

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
                            fetchproduct();
                            swal.fire(
                                'congratulation!',
                                'product updated successfully',
                                'success'
                            )
                        }

                    }
                });

            });


            // add product





        });
    </script>
@endsection

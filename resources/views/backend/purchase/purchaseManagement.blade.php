
@extends('backend.template.defaults')
@section('title', '| purchase')
@section('body')
         <div class="content">
            <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Total Purchase</a></li>
                            <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Purchase::count()}})</li>
                        </ol>
                    </nav>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-left">Add purchase <a href="{{route('purchase-list')}}" class="btn btn-success btn-sm float-right "><i class="fa fa-list-ul">purchase list</i></a>
                        </h3>
                    </div>

                </div>
                    <div class="row">
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

                        <div class="col-md-12">
                            <div class="card data-tables">
                                <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="modal-body">
                                        <ul class="pl-3 text-center list-unstyled" id="saveform_errList"></ul>
                                        <div class="text-center" id="success_message"></div>



                                        <div class="row">


                                            <div class="col-xs-12 col-sm-12 col-md-4 text-left ">
                                                <div class="form-group">
                                                    <strong>Date</strong>
                                                    <input type="datetime-local" name="date"   id="date" class="date form-control " placeholder="Date" >

                                                </div>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 text-left ">
                                                <div class="form-group">
                                                    <strong>Purchase No</strong>
                                                    <input type="number" name="purchase_no"   id="purchase_no" class="purchase_no form-control " placeholder="supplier name" >

                                                </div>

                                            </div>


                                            <div class="col-xs-12 col-sm-12 col-md-4 text-left">
                                                <div class="form-group">
                                                    @php
                                                        $suppliers = \App\Models\Supplier::all();
                                                    @endphp
                                                    <strong>Supplier name</strong>
                                                    <select name="suppliers_id" id="suppliers_id" class="suppliers_id form-control" data-title="Single Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">
                                                        <option>select--suppliers</option>

                                                        @forelse($suppliers as $supplier)

                                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                        @empty
                                                            <option value="is">no supplier</option>

                                                        @endforelse
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                                <div class="form-group">
                                                    @php
                                                        $products = \App\Models\Product::all();
                                                    @endphp
                                                    <strong>Product name</strong>
                                                    <select name="products_id" id="products_id" class="form-control" data-title="Single Unit" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

                                                     <option>--select--option</option>
                                                        @forelse($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @empty
                                                            <option value="">no product</option>

                                                        @endforelse
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 text-left">
                                                <div class="form-group">
                                                    <strong>Category name</strong>
                                                    @php
                                                        $categories = \App\Models\Category::all();
                                                    @endphp
                                                    <select name="category_id" id="category_id" class="category_id form-control" data-title="Single Category" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

                                                        <option value="">select category</option>
                                                        @forelse($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @empty


                                                            <option value="id">no category</option>

                                                        @endforelse
                                                    </select>

                                                </div>
                                            </div>

                                            <div  class="col-xs-12 col-sm-12 col-md-2 ">
        {{--                                        <button type="submit" class="add_product btn btn-primary">Save</button>--}}
                                                <div class="mt-4">
                                                    <a class="btn btn-primary addeventmore"><i class="fa fa fa-plus ">add item</i></a>

                                                </div>
                                            </div>
                                            </div>
                                        <div  class="col-md-12">
                                            <div class="card-body data-tables">
                                                <form method="POST" action="{{route('purchase.store')}}" id="myForm">
                                                    @csrf
                                                    <table class="table-sm table-bordered" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Product Name</th>
                                                            <th width="7%">Pcs/kg</th>
                                                            <th width="10%">Unit Price</th>
                                                            <th>Description</th>
                                                            <th width="10%">Total Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="addRow" class="addRow">

                                                        </tbody>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="5">
                                                            <td>
                                                                <input type="text" name="estimate_amount" value="0" id="estimate_amount" class="form-control form-control-sm text-right estimate_amount" readonly style = "background-color: darkgreen;">
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>

                                                    </table>
                                                    <br>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" type="submit" id="storeButton">purchase store</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        </div>




                                    </div>
                                </div>
                            </div>

                        </div>

            </div>
        </div>


@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.7/handlebars.min.js">

    </script>
    <script id="document-template" type="text/x-handlebars-template">
<tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{date}}">
    <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
    <input type="hidden" name="suppliers_id[]" value="@{{suppliers_id}}">
    <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
    </td>
    <td>
        <input type="hidden" name="products_id[]" value="@{{products_id}}">@{{products_name}}
    </td>
    <td>
        <input type="number" min="1" class="form-control form-control-sm text-right buying_qty"  name="buying_qty[]" value="1">
    </td>
    <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price"  name="unit_price[]" value="">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm text-right"  name="description[]">
    </td>
    <td>
        <input type="number"  class="form-control form-control-sm text-right buying_price"  name="buying_price[]" value="0" readonly>

    </td>
    <td><i class="btn btn-danger fa fa-window-close removeeventmore">x</i></td>
</tr>
    </script>
    <script>
        $(document).ready(function () {
            // fetchproduct();
            // function  fetchproduct() {
            //     $.ajax({
            //         type: "GET",
            //         url:"/fetch-product/",
            //         dataType:"json",
            //         success: function (response) {
            //             // console.log(response.posts);
            //
            //             $('tbody').html("");
            //             $.each(response.products, function (key, item){
            //                 $('tbody').append('<tr>\
            //                                 <td>'+item.id+'</td>\
            //                                <td>'+item.name+'</td>\
            //                                <td>'+item.suppliers_id+'</td>\
            //                                <td>'+item.unit_id+'</td>\
            //                                <td>'+item.category_id+'</td>\
            //                                 <td><button type="button"  value="'+item.id+'" class="edit_product btn btn-primary" ><i class="fa fa-edit">edit</i></button></td>\
            //                                   <td><button type="button" value="'+item.id+'"  class="delete_post btn btn-danger" ><i class="fa fa-trash">delete</i></button></td>\
            //                                 </tr>');
            //             });
            //         }
            //     })
            // }
            $(document).on('click', '.add_product', function (e){
                e.preventDefault();
                // console.log('click');
                var data = {
                    'date' : $('.date').val(),
                    'suppliers_id' : $('#suppliers_id').val(),
                    'category_id' : $('#category_id').val(),
                    'products_id' : $('#products_id').val(),
                    'unit_id' : $('#unit_id').val(),
                    'purchase_no' : $('#purchase_no').val(),
                    'buying_qty' : $('#buying_qty').val(),
                    'unit_price' : $('#unit_price').val(),
                    'buying_price' : $('#buying_price').val(),
                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/post-purchase/",
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
                            // fetchproduct();
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
                        // fetchproduct();
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
                        }

                    }
                });

            });


         // add product





        });
    </script>
    <script>
        $(function (){
            $(document).on('change', '#suppliers_id', function (){

                var suppliers_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url:"{{route('get-category')}}",
                    data:{suppliers_id:suppliers_id},
                    success:function (data){
                        var html = '<option value="">select category</option>';
                        $.each(data,function (key,v){
                            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                });
            });
        });



    </script>
    <script>
        $(function (){
            $(document).on('change', '#category_id', function (){
                var category_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url:"{{route('get-product')}}",
                    data:{category_id:category_id},
                    success:function (data){
                        var html = '<option value="">select product</option>';
                        $.each(data,function (key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#products_id').html(html);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $(document).on("click", ".addeventmore", function (){


                var date = $('#date').val()

                var purchase_no = $('#purchase_no').val();
                var suppliers_id = $('#suppliers_id').val();
                var category_id = $('#category_id').val();
                var category_name= $('#category_id').find('option:selected').text();
                var products_id = $('#products_id').val();
                var products_name= $('#products_id').find('option:selected').text();

                if (date == ''){
                    $.notify("date is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }
                if (purchase_no== ''){
                    $.notify("purchase is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }  if (suppliers_id == ''){
                    $.notify("suppliers is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }

                if ( category_id == ''){
                    $.notify(" category is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }

                if (products_id == ''){
                    $.notify(" category is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }

                var source = $('#document-template').html();
                var template = Handlebars.compile(source);
                var data = {
                    date:date,
                    purchase_no:purchase_no,
                    suppliers_id:suppliers_id,
                    category_id:category_id,
                    category_name:category_name,
                    products_id:products_id,
                    products_name:products_name
                };

                var html = template(data);
                $("#addRow").append(html);
            });

            $(document).on("click", ".removeeventmore", function (event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice()
            });
            $(document).on('keyup click', '.unit_price, .buying_qty',function (){
                var unit_price = $(this).closest("tr").find("input.unit_price").val()

                var qty = $(this).closest("tr").find("input.buying_qty").val()

                var total = unit_price * qty;

                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            })

            function totalAmountPrice() {
                var sum = 0;
                $(".buying_price").each(function () {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0){
                        sum  += parseFloat(value);
                    }
                });
                $('#estimate_amount').val(sum);
            }
        });

    </script>
@endsection

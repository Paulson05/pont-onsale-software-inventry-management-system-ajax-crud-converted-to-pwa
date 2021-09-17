@extends('backend.template.defaults')
@section('title', '| invoice')
@section('body')
         <div class="content">
            <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Total Invoice</a></li>
{{--                            <li class="breadcrumb-item active" aria-current="page">({{\App\Models\invoice::count()}})</li>--}}
                        </ol>
                    </nav>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-left">Add invoice <a href="{{route('invoice.list')}}" class="btn btn-success btn-sm float-right "><i class="fa fa-list-ul">invoice list</i></a>
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



                                      <div class="card-body">
                                          <div class="row align-content-center">

                                              <div class="col-xs-12 col-sm-12 col-md-2 text-left ">
                                                  <div class="form-group">
                                                      <strong>invoice No</strong>
                                                      <input type="number" name="invoice_no"  value="{{$invoice_no}}"   id="invoice_no" class="invoice_no form-control " style="background-color: #b9e7b9" >

                                                  </div>

                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-2 text-left ">
                                                  <div class="form-group">
                                                      <strong>Date</strong>
                                                      <input type="datetime-local" name="date"   id="date" class="date form-control " placeholder="Date" >

                                                  </div>

                                              </div>



                                              <div class="col-xs-12 col-sm-12 col-md-3 text-left">
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

                                              <div class="col-xs-12 col-sm-12 col-md-3 text-left">
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
                                              <div class="col-xs-12 col-sm-12 col-md-2 text-left ">
                                                  <div class="form-group">
                                                      <strong>Stock(pcs/kg)</strong>
                                                      <input type="text" name="current_stock_qty"   id="current_stock_qty" class="current_stock_qty form-control " readonly style="background-color: #b9e7b9" >

                                                  </div>

                                              </div>

                                              <div  class="col-xs-12 col-sm-12 col-md-1 ">
                                                  {{--                                        <button type="submit" class="add_product btn btn-primary">Save</button>--}}
                                                  <div class="mt-4">
                                                      <a class="btn btn-primary addeventmore"><i class="fa fa-plus "></i></a>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                        <div  class="col-md-12">
                                            <div class="card-body data-tables">
                                                <form method="POST" action="{{route('invoice.store')}}" id="myForm">
                                                    @csrf
                                                    <table class="table-sm table-bordered" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Product Name</th>
                                                            <th width="7%">Pcs/kg</th>
                                                            <th width="10%">Unit Price</th>
                                                            <th width="17%">Total Price</th>
                                                            <th width="10%">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="addRow" class="addRow">

                                                        </tbody>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="4" class="text-right">Discount</td>
                                                            <td>
                                                                <input type="text" name="discount_amount" id="discount_amount" class="form" placeholder="enter discount">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">grand total</td>
                                                                <td>
                                                                <input type="text" name="estimate_amount" value="0" id="estimate_amount" class="form-control form-control-sm text-right estimate_amount" readonly style = "background-color: darkgreen;">
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>

                                                    </table>
                                                    <br/>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <textarea class="form-control" id="description" name="description" placeholder=" write description here"></textarea>
                                                        </div>

                                                    </div>
                                                   <div class="form-row">
                                                       <div class="form-group col-md-3">
                                                          <label>paid  status</label>
                                                           <select class="form-control" id="paid_status" name="paid_status">
                                                               <option>select status</option>
                                                               <option>Full paid</option>
                                                               <option>full due</option>
                                                               <option>partical paid</option>
                                                           </select>
                                                           <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="enter paid amount" style="display: none;">
                                                       </div>
                                                       <div class="form-group col-md-9">
                                                           @php
                                                               $customers = \App\Models\Customer::all();
                                                           @endphp
                                                           <label>Customer</label>
                                                           <select class="form-control select2 " id="customers_id" name="customers_id">
                                                               <option>select status</option>
                                                               @forelse($customers as $customer)
                                                                   <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                                                               @empty
                                                                   <p>no customer</p>
                                                               @endforelse
                                                               <option value="0" id="new_customer" class="new_customer">new customer</option>
                                                           </select>

                                                       </div>
                                                   </div>
                                                 <div class="form-row new_customer" style="display: none;">
                                                     <div class="form-group col-md-4">
                                                         <input type="text" name="name" id="name" class="form-control" placeholder="write customer name">
                                                     </div>
                                                     <div class="form-group col-md-4">
                                                         <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="write mobile no">
                                                     </div>
                                                     <div class="form-group col-md-4">
                                                         <input type="text" name="address" id="address" class="form-control" placeholder="write address">
                                                     </div>

                                                 </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" type="submit" id="storeButton">invoice store</button>
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
    <input type="hidden" name="date" value="@{{date}}">
    <input type="hidden" name="invoice_no" value="@{{invoice_no}}">

    <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
    </td>
    <td>
        <input type="hidden" name="products_id[]" value="@{{products_id}}">@{{products_name}}
    </td>
    <td>
        <input type="number" min="1" class="form-control form-control-sm text-right selling_qty"  name="selling_qty[]" value="1">
    </td>
    <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price"  name="unit_price[]" value="">
    </td>

    <td>
        <input type="number"  class="form-control form-control-sm text-right selling_price"  name="selling_price[]" value="0" readonly>

    </td>
    <td><i class="btn btn-danger fa fa-window-close removeeventmore"></i></td>
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

                var invoice_no = $('#invoice_no').val();
                var suppliers_id = $('#suppliers_id').val();
                var category_id = $('#category_id').val();
                var category_name= $('#category_id').find('option:selected').text();
                var products_id = $('#products_id').val();
                var products_name= $('#products_id').find('option:selected').text();

                if (date == ''){
                    $.notify("date is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
                    return false;
                }
                if (invoice_no== ''){
                    $.notify("purchase is required", {getCaretGlobalPosition: 'top right', classname:  'error'});
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
                    invoice_no:invoice_no,
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

                var qty = $(this).closest("tr").find("input.selling_qty").val()

                var total = unit_price * qty;

                $(this).closest("tr").find("input.selling_price").val(total);
                $('#discount_amount').trigger('keyup');
            });

            $(document).on('keyup', '#discount_amount', function (){
                totalAmountPrice()
            });
            function totalAmountPrice() {
                var sum = 0;
                $(".selling_price").each(function () {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0){
                        sum  += parseFloat(value);
                    }
                });
                  var discount_amount = parseFloat($('#discount_amount').val());
                  if(!isNaN(discount_amount) && discount_amount.length !=0){
                      sum -= parseFloat(discount_amount);
                  }
                $('#estimate_amount').val(sum);
            }
        });

    </script>
    <script>
        $(function (){
            $(document).on('change', '#products_id', function (){
                var products_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url:"{{route('check-product-stock')}}",
                    data:{products_id:products_id},
                    success:function (data){
                        $('#current_stock_qty').val(data)
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('change', '#paid_status', function (){
           var paid_status = $(this).val();
           if (paid_status == 'partial_paid'){
               $('.paid_amount').show();
           }
           else {
               $('.paid_amount').hide();
           }
        });

        $(document).on('change', '#customers_id', function (){

            var customers_id = $(this).val();
            if (customers_id == '0'){
                $('.new_customer').show();
            }
            else {
                $('.new_customer').hide();
            }
        });
    </script>
@endsection

@extends('backend.template.defaults')
@section('title', '|supplier-product-wise')
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
                    <h3 class="text-left">Manage Supplier/Product WISE <a href="#" class=" float-right "></a>
                    </h3>
                </div>

            </div>
            <div class="row">
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
                                    <div class="row ">


                                        <div class="col-xs-12 col-sm-12 col-md-12  text-center ">

                                                <strong>supplier/wise/report</strong>
                                                <input type="radio" name="supplier_product_wise"   id="date" class="search_value" value="supplier_wise" >

                                            <strong>product/wise/report</strong>
                                            <input type="radio" name="supplier_product_wise"   id="date" class="search_value" value="product_wise"  >


                                        </div>


                                    </div>
                                    <div class="row justify-content-center " >
                                        <div class="col-xs-12 col-sm-12 col-md-6 show_supplier" style="display: none;">
                                            <div class="form-group">
                                                <form action="{{route('supplier.wise.report.pdf')}}" method="GET" id="supplierwiseform">
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
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-success">search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div>

                                        </div>
                                    <div class="container show_product " style="display: none;">
                                        <form method="GET" action="{{route('product.wise.report.pdf')}}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-xs-12 col-sm-12 col-md-6 text-left">
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

                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-success">search</button>
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
    </div>


@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.7/handlebars.min.js">

    </script>


    <script>
        $(document).on('change', '.search_value', function (){

            var search_value = $(this).val();
            if (search_value == 'supplier_wise'){
                $('.show_supplier').show();
            }
            else {
                $('.show_supplier').hide();
            }
            if (search_value == 'product_wise'){
                $('.show_product').show();
            }
            else {
                $('.show_product').hide();
            }
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
@endsection

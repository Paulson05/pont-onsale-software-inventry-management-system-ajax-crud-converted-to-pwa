@extends('backend.template.defaults')
@section('title', '| stock report')
@section('body')
    <div class="content">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Stock Report</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Product::count()}})</li>
                </ol>
            </nav>
            <div class="row">


                <div class="col-md-12 text-right">
                    <a href="{{route('stock.report.pdf')}}" class="btn btn-primary " >Download PDF</a>
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
                                        <th>S/N</th>
                                        <th>Supplier name</th>
                                        <th>Category</th>
                                        <th>product</th>
                                        <th>In.Qty</th>
                                        <th>Out.Qty</th>
                                        <th>Stock</th>
                                        <th>unit</th>


                                    </tr>
                                    </thead>

                                    <tbody>
                                         @foreach($products as $product)
                                             @php
                                             $buying_total = \App\Models\Purchase::where('category_id', $product->category_id)->where('products_id',$product->id)->where('status', '1')->sum('buying_qty');
                                              $selling_total = \App\Models\invioceDetail::where('category_id',  $product->category_id)->where('products_id',$product->id)->where('status', '1')->sum('selling_qty')
                                             @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$product->supplier->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$buying_total}}</td>
                                        <td>{{$selling_total}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->unit->name}}</td>



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


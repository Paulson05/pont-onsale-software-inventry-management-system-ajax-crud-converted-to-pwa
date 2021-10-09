@extends('backend.template.defaults')
@section('title', '| product barcode')
@section('body')
    <div class="content">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Product Barcode</a></li>
                    {{--                            <li class="breadcrumb-item active" aria-current="page">({{\App\Models\invoice::count()}})</li>--}}
                </ol>
            </nav>

            <div class="row ">

                @foreach($productBarCode as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                {!!$product->barcode !!}
                                <h4 class="text-center">{{$product->product_code}}</h4>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>


    </div>
    </div>


@endsection
@section('script')


    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-md-dd'
        });
        $('.datepicker1').datepicker({
            format: 'yyyy-md-dd'
        });
    </script>
@endsection

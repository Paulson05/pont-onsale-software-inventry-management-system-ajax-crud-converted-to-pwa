@extends('backend.template.default')
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
                    <h3 class="text-left">Manage Customer WISE <a href="#" class=" float-right "></a>
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

                                                <strong>customer wise credit report</strong>
                                                <input type="radio" name="customer_wise_report"   id="date" class="search_value" value="customer_wise_credit" >

                                            <strong>customer wise paid report</strong>
                                            <input type="radio" name="customer_wise_report"   id="date" class="search_value" value="customer_wise_paid"  >


                                        </div>


                                    </div>
                                    <div class="row justify-content-center " >
                                        <div class="col-xs-12 col-sm-12 col-md-6 show_credit" style="display: none;">
                                            <div class="form-group">
                                                <form action="{{route('customer.wise.credit.pdf')}}" method="GET" id="supplierwiseform">
                                                    @csrf
                                                @php
                                                    $customers = \App\Models\Customer::all();
                                                @endphp
                                                <strong>Customer</strong>
                                                <select name="suppliers_id" id="suppliers_id" class="suppliers_id form-control" data-title="Single Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">
                                                    <option>--select customer--</option>
                                                    @forelse($customers as $customer)

                                                        <option value="{{$customer->id}}">{{$customer->name}}-{{$customer->mobile_no}}-{{$customer->address}}</option>
                                                    @empty
                                                        <option value="is">no customer</option>

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
                                    <div class="container show_paid " style="display: none;">
                                        <form method="GET" action="{{route('customer.wise.paid.pdf')}}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                                    <div class="form-group">
                                                        @php
                                                            $customers = \App\Models\Customer::all();
                                                        @endphp
                                                        <strong>Customer</strong>
                                                        <select name="suppliers_id" id="suppliers_id" class="suppliers_id form-control" data-title="Single Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">
                                                            <option>--select customer--</option>
                                                            @forelse($customers as $customer)

                                                                <option value="{{$customer->id}}">{{$customer->name}}-{{$customer->mobile_no}}-{{$customer->address}}</option>
                                                            @empty
                                                                <option value="is">no customer</option>

                                                            @endforelse
                                                        </select>
                                                        <div class="col-sm-3">
                                                            <button class="btn btn-success">search</button>
                                                        </div>
                                                    </div>
                                                </div>


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
            if (search_value == 'customer_wise_credit'){
                $('.show_credit').show();
            }
            else {
                $('.show_credit').hide();
            }
            if (search_value == 'customer_wise_paid'){
                $('.show_paid').show();
            }
            else {
                $('.show_paid').hide();
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

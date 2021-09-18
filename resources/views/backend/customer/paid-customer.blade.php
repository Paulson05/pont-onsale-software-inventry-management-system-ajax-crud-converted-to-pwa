@extends('backend.template.defaults')
@section('title', '| customer creadit report')
@section('body')
    <div class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Paid Customer Report</a></li>
                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\Customer::count()}})</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a  class="btn btn-success" href="{{route('paid.customer.pdf')}}">download</a>

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
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($allData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
{{--                                            <td>{{$data->customer->name}} {{$data->customer->mobile_no}}-{{$data->customer->address}} </td>--}}
                                            <td>{{$data->invoice->invoice_no}}</td>
                                            <td>{{date('d-m-y',strtotime($data->invoice->date))}}</td>
                                            <td>${{$data->due_amount}}</td>
                                            <td><button type="button"   class="edit_customer btn btn-primary" >edit</button></td>
                                            <td><a href="{{route('invoice.detail.pdf', $data->invoice_id )}}"   class="btn btn-primary" >view</a></td>

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


    </div>
@endsection


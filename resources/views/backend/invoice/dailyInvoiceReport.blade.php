@extends('backend.template.defaults')
@section('title', '| invoice')
@section('body')
         <div class="content">
            <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Daily Invoice Report</a></li>
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



                        </div>

                        <div class="col-md-12">
                            <div class="card data-tables">
                                <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">

                                    <div class="modal-body">

                                      <div class="card-body">
                                          <div class="row align-content-center">
                                              <div class="container">
                                                  <form class="form-row" method="GET" action="{{Route('invoice.daily.report.pdf')}}" target="_blank" id="myForm">
                                                      <div class="col-xs-12 col-sm-12 col-md-5 text-left ">
                                                          <div class="form-group">
                                                              <strong>Start Date</strong>
                                                              <input type="datetime-local" name="start_date"   id="start_date" class="datepicker form-control  " placeholder="Date" >

                                                          </div>

                                                      </div>
                                                      <div class="col-xs-12 col-sm-12 col-md-5 text-left ">
                                                          <div class="form-group">
                                                              <strong>End Date</strong>
                                                              <input type="datetime-local" name="end_date"   id="end_date" class="datepicker1 form-control  " placeholder="Date" >

                                                          </div>
                                                      </div>
                                                      <div class="col-xs-12 col-sm-12 col-md-1 text-left mt-4">
                                                          <div class="form-group">
                                                              <button type="submit" class="btn btn-success">search</button>
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


    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-md-dd'
        });
        $('.datepicker1').datepicker({
            format: 'yyyy-md-dd'
        });
    </script>
@endsection

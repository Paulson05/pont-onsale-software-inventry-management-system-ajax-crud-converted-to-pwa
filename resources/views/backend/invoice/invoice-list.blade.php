@extends('backend.template.defaults')
@section('title', '| invoice-list')
@section('body')
    <div class="content">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Invoice</a></li>
{{--                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\invoice::count()}})</li>--}}
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{route('invoice.index')}}" class="btn btn-primary " >add</a>
                    {{--add modal--}}


                </div>

                <div class="col-md-12">
                    <div class="card data-tables">
                        <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="fresh-datatables justify-content-center ">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover table-responsive container justify-content-center" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Invoice No</th>
                                        <th>Name</th>
                                        <th>date</th>
                                        <th>Description</th>
                                        <th>status</th>
                                        <th>approved</th>

                                    </tr>
                                    </thead>
                                          @php
                                          $invoices = \App\Models\invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                                          @endphp
                                    <tbody>

                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>#{{$invoice->invoice_no}}</td>
                                            <td>
                                                {{$invoice['payment']['customer']['name']}}
                                                {{$invoice->payment->customer->mobile_no}}-  {{$invoice->payment->customer->address}}
                                            </td>

                                            <td>{{date('d-m-y', strtotime($invoice->date))}}</td>
                                            <td>{{$invoice->description}}</td>
                                            <td>
                                                @if($invoice->status == '0')
                                                    <button class=" btn btn-danger">pending</button>
                                                @elseif($invoice->status == '1')
                                                    <button class="btn btn-success">approved</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($invoice->status == '0')
                                                    <a href="{{route('invoice.approve', $invoice->id)}}"><button class="btn btn-outline-success"><i class="fa fa-check-circle" style="color: black;"></i></button></a>
                                            @endif
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
                    'name' : $('.name').val(),
                    'suppliers_id' : $('#suppliers_id').val(),
                    'unit_id' : $('#unit_id').val(),
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
@endsection

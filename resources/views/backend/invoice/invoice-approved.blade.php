@extends('backend.template.defaults')
@section('title', '| invoice-list')
@section('body')
    <div class="content">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Invoice No  #{{$invoice->invoice_no}} {{date('d-m-y',strtotime($invoice->date))}}</a></li>
{{--                    <li class="breadcrumb-item active" aria-current="page">({{\App\Models\invoice::count()}})</li>--}}
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{route('invoice.list')}}" class="btn btn-primary " >pending list</a>

                </div>

                <div class="card-body">
                    @php
                    $payment = \App\Models\payment::where('invoice_id', $invoice->id)->first();
                    @endphp
                    <table style="width: 100%;">
                        <tbody>
                        <tr class="text-center">

                            <td width = '15%' ><p><strong>customer Info</strong></p></td>
                            <td width = '25%' ><p><strong>Name: {{$payment['customer']['name']}}</strong></p></td>
                            <td width = '25%' ><p><strong>Mobile No: {{$payment['customer']['mobile_no']}}</strong></p></td>
                            <td width = '35%' ><p><strong>Address : {{$payment['customer']['address']}}</strong></p></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><p><strong>Description {{$invoice->description}}</strong></p></td>
                        </tr>
                        </tbody>
                    </table>
                    <form method="post" action="{{route('approval.store', $invoice->id)}}">
                        @csrf
                        <table border="1" width="100%">
                            <thead>
                            <tr  class="text-center">
                                <td>S/N</td>
                                <td>Category</td>
                                <td>Product Name</td>
                                <td>Current stock</td>
                                <td>Qty</td>
                                <td>Unit price</td>
                                <td>Total Price</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_sum = '0';
                            @endphp
                            @foreach($invoice['invoicedetails'] as $data)
                                <tr   class="text-center">
                                    <input type="hidden" name="category_id[]" value="{{$data->category_id}}">
                                    <input type="hidden" name="products_id[]" value="{{$data->products_id}}">
                                    <input type="hidden" name="selling_qty[{{$data->id}}]" value="{{$data->selling_qty}}">

                                    <td   >{{$loop->iteration}}</td>
                                    <td >{{$data['category']['name']}}</td>
                                    <td >{{$data['product']['name']}}</td>

                                    <td>{{$data['product']['quantity']}}</td>
                                    <td  >{{$data->selling_qty}}</td>
                                    <td >{{$data->unit_price}}</td>
                                    <td >{{$data->selling_price}}</td>
                                </tr>
                                @php
                                    $total_sum += $data->selling_price;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                                <td  class="text-center" ><strong>{{$total_sum}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Discount</strong></td>
                                <td  class="text-center" ><strong>{{$payment->paid_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Due Amount</strong></td>
                                <td  class="text-center" ><strong>{{$payment->due_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                                <td  class="text-center" ><strong>{{$payment->total_amount}}</strong></td>
                            </tr>
                            </tbody>

                        </table>
                        <button type="submit" class="btn btn-primary mt-2">approved invoice</button>
                    </form>
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

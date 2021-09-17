<!DOCTYPE html>
<html>

<body>

<div class="container">
    @php
        $payment = \App\Models\payment::where('invoice_id', $invoice->id)->first();
    @endphp
      <table>
          <thead>
          <tr class="text-center">
              <td style="width: 10%">customer Info</td>
              <td style="width: 15%">Name: {{$payment['customer']['name']}}</td>
              <td style="width: 15%">Mobile No: {{$payment['customer']['mobile_no']}}</td>
              <td style="width: 15%">Address : {{$payment['customer']['address']}}</td>
              <td style="width: 25%">Description {{$invoice->description}}</td>




          </tr>
          </thead>
      </table>
    <form method="post" action="{{route('approval.store', $invoice->id)}}">
        @csrf
        <table border="1" style="width: 100%; ">
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
        <div class="row">
            <div class="col-md-12">
                <hr style="margin-top: 50px;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 40%; text-align: center;"><p>customer signature</p></td>
                        <td style="width: 20%; text-align: center;"></td>
                        <td style="width: 40%; text-align: center;"><p>seller signature</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</div>


</body>
</html>

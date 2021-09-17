<!DOCTYPE html>
<html>

<body>

<div class="container">

    <table>
      <tbody>
           <tr>
               <td>invoice no #{{$payment['invoice']['invoice_no']}}
               <td><span style="font-size: 70px; padding: 3px 10px 3px 10px ">bucci shoping mall</span></td>
               <td>
                   <span>showroom ni : 8665444</span><br>
                   owner no: 09097655
               </td>
           </tr>
      </tbody>
    </table>
{{--    @php--}}
{{--        $payment = \App\Models\payment::where('invoice_id',$invoice_id->id)->first();--}}
{{--    @endphp--}}
    <table>
        <thead>
        <tr class="text-center">
            <td style="width: 10%">customer Info</td>
            <td style="width: 15%">Name: {{$payment['customer']['name']}}</td>
            <td style="width: 15%">Mobile No: {{$payment['customer']['mobile_no']}}</td>
            <td style="width: 15%">Address : {{$payment['customer']['address']}}</td>
        </tr>
        </thead>
    </table>
    <form method="post" action="">
        @csrf
        <table border="1" style="width: 100%; ">
            <thead>
            <tr  class="text-center">
                <td>S/N</td>
                <td>Category</td>
                <td>Product Name</td>
                <td>Qunatity</td>
                <td>Unit</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>
         @php
             $total_sum = '0';
             $invoice_details = \App\Models\invioceDetail::where('invoice_id', $payment->invoice_id)->get();
         @endphp
         @foreach($invoice_details as $detail)
                     <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>{{$detail->category->name}}</td>
                         <td>{{$detail->product->name}}</td>
                         <td>{{$detail->selling_qty}}</td>
                         <td>{{$detail->unit_price}}</td>
                         <td>{{$detail->selling_price}}</td>
                     </tr>
             @php
             $total_sum += $detail->selling_price;
             @endphp

         @endforeach
         <tr>
             <td colspan="5" style="text-align: right">GrandTotal</td>
             <td>{{$total_sum}}</td>
         </tr>
         <tr>
             <td colspan="5" class="text-right"><strong>Discount</strong></td>
             <td  class="text-center" ><strong>{{$payment->paid_amount}}</strong></td>
         </tr>
         <tr>
             <td colspan="5" class="text-right"><strong>Due Amount</strong></td>
             <td  class="text-center" ><strong>{{$payment->due_amount}}</strong></td>
         </tr>
         <tr>
             <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
             <td  class="text-center" ><strong>{{$payment->total_amount}}</strong></td>
         </tr>
            </tbody>

        </table>
        <div class="row">
            <div class="col-md-12">
                <hr style="margin-top: 50px;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 40%; text-align: center;"><p></p></td>
                        <td style="width: 20%; text-align: center;"></td>
                        <td style="width: 40%; text-align: center;"><p>owener signature</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</div>


</body>
</html>

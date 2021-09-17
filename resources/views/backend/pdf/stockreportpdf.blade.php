<!DOCTYPE html>
<html>

<body>

<div class="container">

      <table>
          <thead>
{{--          <tr class="text-center">--}}
{{--              <td style="width: 10%">customer Info</td>--}}
{{--              <td style="width: 15%">Name: {{$payment['customer']['name']}}</td>--}}
{{--              <td style="width: 15%">Mobile No: {{$payment['customer']['mobile_no']}}</td>--}}
{{--              <td style="width: 15%">Address : {{$payment['customer']['address']}}</td>--}}
{{--              <td style="width: 25%">Description {{$invoice->description}}</td>--}}




          </tr>















          </thead>
      </table>
    <form method="post" action="">
        @csrf
        <table border="1" style="width: 100%; ">
            <thead>
            <tr  class="text-center">
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

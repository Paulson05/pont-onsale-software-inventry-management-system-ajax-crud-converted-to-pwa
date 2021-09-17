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
        <strong>Supplier Name: {{$products['0']['supplier']['name']}}</strong>
        <table border="1" style="width: 100%; ">
            <thead>
            <tr  class="text-center">
                <th>S/N</th>
                <th>Category</th>
                <th>product</th>
                <th>Stock</th>
                <th>unit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$product->category->name}}</td>
                    <td>{{$product->name}}</td>
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
                        <td style="width: 40%; text-align: center;"><p></p></td>
                        <td style="width: 20%; text-align: center;"></td>
                        <td style="width: 40%; text-align: center;"><p>owner signature</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</div>


</body>
</html>

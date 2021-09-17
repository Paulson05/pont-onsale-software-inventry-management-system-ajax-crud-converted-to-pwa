<!DOCTYPE html>
<html>

<body>

<div class="container">


    <form method="post" action="">
        @csrf
        <table border="1" style="width: 100%; ">
            <thead>
            <tr  class="text-center">
                <td>S/N</td>
                <td>Customer name</td>
                <td>invoice No</td>
                <td>Date</td>
                <td>Description</td>
                <td>Amount</td>
            </tr>
            </thead>
            <tbody>

            @foreach($invoices as $invoice)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$invoice['payment']['customer']['name']}}
                        {{$invoice->payment->customer->mobile_no}}-  {{$invoice->payment->customer->address}}
                    </td>
                    <td>#{{$invoice->invoice_no}}</td>
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
                            <a href="{{route('invoice.approve', $invoice->id)}}"><i>approved</i></a>
                    @endif
                    <td>


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
                        <td style="width: 40%; text-align: center;"><p>owener signature</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</div>


</body>
</html>

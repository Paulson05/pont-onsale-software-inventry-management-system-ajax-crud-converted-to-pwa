<!DOCTYPE html>
<html>

<body>

<div class="container">


    <form method="post" action="">
        @csrf
        <table border="1" style="width: 100%; ">
            <thead>
            <tr class="text-center">
                <td>S/N</td>
                <td>Customer Name</td>
                <td>Invoice No</td>
                <td>Date</td>
                <td>Amount</td>


            </tr>
            </thead>

            <tbody>
            @php
                $total_due = '0';
            @endphp
            @foreach($customer as $data)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->customer->name}} {{$data->customer->mobile_no}}-{{$data->customer->address}} </td>
                    <td>invove no #{{$data->invoice->invoice_no}}</td>
                    <td>{{date('d-m-y',strtotime($data->invoice->date))}}</td>
                    <td>${{$data->due_amount}}</td>


                </tr>
            @endforeach
            @php
            $total_due += $data->due_amount
            @endphp
            <tr>
                <td colspan="4" style="text-align: right">GrandTotal</td>
                <td>{{$total_due}}</td>
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

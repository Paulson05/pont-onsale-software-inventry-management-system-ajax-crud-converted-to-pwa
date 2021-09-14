<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.customer.customerManagement');
    }
    public function customerReport(){
       $customer = payment::whereIn('paid_status', ['Full paid', 'partial_paid'])->get();
        return view('backend.pages.customer.creadit-customer-report')->with([
            'customer' => $customer,
        ]);
    }

    public  function customerReportPdf(){
        $data['customer'] = payment::whereIn('paid_status', ['Full paid', 'partial_paid'])->get();
        $pdf = \PDF::loadView('backend.pages.pdf.credit-customer-report-pdf',$data);
        return $pdf->stream('invoice.pdf');
    }
public function invoiceDetailPdf($invoice_id){
      $data['payment'] =payment::where('invoice_id', $invoice_id)->first();
    $pdf = \PDF::loadView('backend.pages.pdf.invoice-details-pdf',$data);
    return $pdf->stream('invoice.pdf');
}

public function paidCustomer(){
        $allData = payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.pages.customer.paid-customer')->with([
            'allData' => $allData
        ]);

}
    public function paidCustomerPdf(){
        $data['allData'] = payment::where('paid_status', '!=', 'full_due')->get();
        $pdf = \PDF::loadView('backend.pages.pdf.paid-customer-report-pdf',$data);
        return $pdf->stream('invoice.pdf');
    }

    public function customerWiseReport(){
        return view('backend.pages.customer.customer-wise-report');
    }

    public function customerWiseCreditPdf(Request $request){
        $data['allData'] = payment::where('customers_id',$request->customer_id)->whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        $pdf = \PDF::loadView('backend.pages.pdf.customer-wise-credit-pdf',$data);
        return $pdf->stream('invoice.pdf');
    }
    public function customerWisePaidPdf(Request $request){
        $data['allData'] = payment::where('customers_id',$request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        $pdf = \PDF::loadView('backend.pages.pdf.customer-wise-paid-pdf',$data);
        return $pdf->stream('invoice.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email'=>  'required',
            'mobile_no' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile_no= $request->mobile_no;
            $customer->address = $request->address;
//        $supplier->created_by = Auth::user()->id;
            $customer->save();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }

    public function  fetchcustomer(){
        $customers = Customer::all();
        return response()->json([
            'customers'=>$customers,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }


    public function edit($id)
    {
        $customer =Customer::find($id);

        if ($customer)
        {
            return response()->json([
                'status' => 200,
                'customer' => $customer,

            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'message' => 'customer added succesfully',

            ]);
        }
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email'=>  'required',
            'mobile_no' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile_no= $request->mobile_no;
            $customer->address = $request->address;
//        $supplier->created_by = Auth::user()->id;
            $customer->update();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }

    public function destroy($id)
    {
        $post = Customer::find($id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'post deleted successfully',

        ]);
    }
}

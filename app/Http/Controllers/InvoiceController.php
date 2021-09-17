<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\invioceDetail;
use App\Models\invoice;
use App\Models\payment;
use App\Models\paymentDetails;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(){
        $data['categories'] = Category::all();
        $invoice_data = invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null){
            $firstReg = '0';
            $data['invoice_no'] = $firstReg+1;
//         dd($invoice_no);

        }
        else{
            $invoice_data = invoice::orderBy('id', 'desc')->first()->invoice_no;

            $data['invoice_no'] = $invoice_data+1;
        }
        $data['customers'] = Customer::all();
        $data['date'] = date('y-m-d');
        return view('backend.invoice.index', $data);
    }
    public function invoiceList(){
        return view('backend.invoice.invoice-list');
    }
    public function pendingList(){
        return view('backend.invoice.invoice-pending-list');
    }

    public function store(Request $request){
//        dd('ok');
        if ($request->category_id == null){
            return redirect()->back()->with('error', 'sorry you did not select any product  ');
        }
        else{
            if ($request->paid_amount>$request->estimate_amount){
                return redirect()->back()->with('error', 'sorry paid amount is maximum than total amount');
            }
            else{
                $invoice = new invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
//                $invoice->created_by = Auth::user()->id;
                $invoice->save();
                DB::transaction(function () use($request,$invoice){
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for($i=0; $i <$count_category; $i++){
                            $invoice_details = new invioceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->products_id = $request->products_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status= '0';
                            $invoice_details->save();
                        }
                        if ($request->customers_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customers_id =$request->customers_id ;
                        }else{
                            $customers_id =$request->customers_id ;

                        }
                        $payment = new payment();
                        $payment_details = new paymentDetails();
                        $payment->invoice_id = $invoice->id;
                        $payment->customers_id = $request->customers_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        }
                        elseif ($request->paid_status == 'full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount =$request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }elseif($request->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount =$request->estimated_amount-$request->paid_amount;
                            $payment_details->current_paid_amount =  $request->paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();
                    }
                });
            }
        }
        return redirect()->route('invoice.index');
    }

    public function approve($id){

        $invoice = invoice::with(['invoicedetails'])->find($id);

        return view('backend.invoice.invoice-approved')->with([
            'invoice'=> $invoice,
        ]);
    }
   public  function approvelStore(Request $request, $id){

        foreach ($request->selling_qty as $key => $val){
            $invoice_details = invioceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->products_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error', 'sorry  you approved maximun value ');
            }
        }

        $invoice = invoice::find($id);
//        $invoice->approved_by = Auth::user()->id;
       $invoice->status = '1';
       DB::transaction(function () use ($request, $invoice, $id){
           foreach ($request->selling_qty as $key => $val){
                      $invoice_details = invioceDetail::where('id', $key)->first();
                      $invoice_details->status = '1';
                      $invoice_details->save();
                      $product = Product::where('id', $invoice_details->products_id)->first();
                      $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                      $product->save();
           }
           $invoice->save();
       });
       return redirect()->route('invoice.index')->with('succcess', 'successfully approved');
   }

   public function printInvoiceList(){

               $alldata  = invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
               return view('backend.invoice.invoice-print')->with([
                  'alldata' => $alldata,
               ]);
   }
   public function printInvoice($id){

        $data['invoice'] = invoice::with(['invoicedetails'])->find($id);

       $pdf = \PDF::loadView('backend.pages.pdf.invoice',$data);
       return $pdf->stream('invoice.pdf');

   }

   public function DailyInvoice(){

       return view('backend.invoice.dailyInvoiceReport');
   }

   public function DailyInvoicePdf(Request $request){
               $sdate = date('y-m-d', strtotime($request->start_date));
              $edate = date('y-m-d', strtotime($request->end_date));
              $data['invoices'] = invoice::whereUpdatedBy('date', [$sdate,$edate])->where('status', '1')->get();
              $data['start_date']   = date('y-m-d', strtotime($request->start_date));
              $data['end_date']  = date('y-m-d', strtotime($request->end_date));
              $pdf = \PDF::loadView('backend.pdf.daily-invoice-report-pdf',$data);
              return $pdf->stream('invoice.pdf');
   }
}


<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockReport(){
        $products = Product::orderBy('suppliers_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.stock.index')->with([
            'products' => $products,
        ]);
    }
    public function StockReportPdf(){
        $data['products'] =  Product::orderBy('suppliers_id', 'asc')->orderBy('category_id', 'asc')->get();
        $pdf = \PDF::loadView('backend.pdf.stockreportpdf',$data);
        return $pdf->stream('invoice.pdf');
    }

    public  function supplierWiseReport(){

        return view('backend.stock.supplier-product-wise');
    }
public  function supplierWiseReportPdf(Request $request){
    $data['products'] =  Product::orderBy('suppliers_id', 'asc')->orderBy('category_id', 'asc')->where('suppliers_id',$request->suppliers_id)->get();

    $pdf = \PDF::loadView('backend.pdf.supplierwisestockreportpdf',$data);
    return $pdf->stream('invoice.pdf');
}
public function productWiseReportPdf(Request $request){
    $data['product'] =  Product::where('category_id',$request->category_id)->where('id',$request->products_id)->first();

    $pdf = \PDF::loadView('backend.pdf.productwisestockreportpdf',$data);
    return $pdf->stream('invoice.pdf');}
}




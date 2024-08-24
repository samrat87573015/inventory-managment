<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    function invoicePage()
    {
        return view('pages.invoice.index');
    }

    function createSalePage(){
        return view('pages.invoice.create-sale');
    }

    function createInvoice( Request $request )
    {

        DB::beginTransaction();

        try{

            $userID = $request->header('userID');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'user_id' => $userID,
                'customer_id' => $customer_id,
                'total' => $total,
                'discount' => $discount,
                'payable' => $payable,
                'vat' => $vat
            ]);

            $invoiceID = $invoice->id;


            $products = $request->input('products');
            foreach ($products as $product) {
                InvoiceProducts::create([
                    'invoice_id' => $invoiceID,
                    'user_id' => $userID,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'salePrice' => $product['salePrice'],
                ]);
            }


            DB::commit();

            return 1;

        }catch (\Exception $e){
            DB::rollBack();
            return 0;
        }


    }


    function deleteInvoice( Request $request ){

        DB::beginTransaction();

        try{

            $userID = $request->header('userID');

            InvoiceProducts::where('user_id', $userID)
                ->where('invoice_id', $request->input('invoiceID'))
                ->delete();

            Invoice::where('user_id', $userID)
                ->where('id', $request->input('invoiceID'))
                ->delete();


            DB::commit();
            return 1;
        }catch (\Exception $e){
            DB::rollBack();
            return 0;
        }
    }


    function invoiceSeleted( Request $request )
    {
        $userID = $request->header('userID');
        return Invoice::where('user_id', $userID)->with('customer')->get();
    }


    function invoiceDetails( Request $request ){
        $userID = $request->header('userID');

        $customerDetails = Customer::where('user_id', $userID)->where('id', $request->input('customer_id'))
        ->first();

        $invoice = Invoice::where('user_id', $userID)->where('id', $request->input('invoice_id'))->first();

        $invoiceProducts = InvoiceProducts::where('user_id', $userID)->where('invoice_id', $request->input('invoice_id'))->with('product')->get();


        return [
            'customer' => $customerDetails,
            'invoice' => $invoice,
            'products' => $invoiceProducts
        ];



    }


}

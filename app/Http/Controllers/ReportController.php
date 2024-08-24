<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    function saleReport()
    {
        return view('report.create-report');
    }


    function ganaratSaleReport(Request $request)
    {
        $userID = $request->header('userID');

        $fromDate = date('Y-m-d', strtotime($request->fromDate));
        $toDate = date('Y-m-d', strtotime($request->toDate));

        $total = Invoice::where('user_id', $userID)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('total');
        $vat = Invoice::where('user_id', $userID)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('vat');
        $discount = Invoice::where('user_id', $userID)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('discount');
        $payable = Invoice::where('user_id', $userID)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('payable');
        $list = Invoice::where('user_id', $userID)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->with('customer')->get();

        $data = [
            'total' => $total,
            'vat' => $vat,
            'discount' => $discount,
            'payable' => $payable,
            'list' => $list,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ];


       $pdf = Pdf::loadView('report.sale-report', $data);
       return $pdf->download('invoice.pdf');

    }


}

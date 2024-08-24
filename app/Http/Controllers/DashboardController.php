<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
    {
        return view('pages.Dashboard.dashboard');
    }

    function dashboardHeaderInfo()
    {
        $userID = request()->header('userID');

        $productCount = Product::where('user_id', $userID)->count();
        $customerCount = Customer::where('user_id', $userID)->count();
        $categoryCount = Category::where('user_id', $userID)->count();
        $invoiceCount = Invoice::where('user_id', $userID)->count();
        $totalSaleAmount = Invoice::where('user_id', $userID)->sum('total');
        $TotalVat = Invoice::where('user_id', $userID)->sum('vat');
        $TotalPayable = Invoice::where('user_id', $userID)->sum('payable');

        return response()->json([
            'productCount' => $productCount,
            'customerCount' => $customerCount,
            'categoryCount' => $categoryCount,
            'invoiceCount' => $invoiceCount,
            'totalSaleAmount' => $totalSaleAmount,
            'TotalVat' => $TotalVat,
            'TotalPayable' => $TotalPayable
        ]);
    }


}

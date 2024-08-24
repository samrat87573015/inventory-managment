<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{

    function customerPage(){
        return view('pages.customer.index');
    }


    function getCustomerList(Request $request){
        $userID = $request->header('userID');
        $customerList= Customer::where('user_id', $userID)->get();
        return $customerList;
    }


    function getCustomerID(Request $request){
        $userID = $request->header('userID');
        $customerID = $request->input('customerID');
        return Customer::where('id', $customerID)->where('user_id', $userID)->first();
    }

    function createCustomer(Request $request){
        try{
            $userID = $request->header('userID');
            $customerName = $request->input('customerName');
            $customerEmail = $request->input('customerEmail');
            $customerPhone = $request->input('customerPhone');
            $customerAddress = $request->input('customerAddress');
            Customer::create([
                'customerName' => $customerName,
                'customerEmail' => $customerEmail,
                'customerPhone' => $customerPhone,
                'customerAddress' => $customerAddress,
                'user_id' => $userID
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer created failed'
            ], 200);
        }


    }


    function updateCustomer(Request $request){
        
            $userID = $request->header('userID');
            $customerID = $request->input('customerID');
            $customerName = $request->input('customerName');
            $customerEmail = $request->input('customerEmail');
            $customerPhone = $request->input('customerPhone');
            $customerAddress = $request->input('customerAddress');

            $count= Customer::where('id', $customerID)->where('user_id', $userID)->update([
                'customerName' => $customerName,
                'customerEmail' => $customerEmail,
                'customerPhone' => $customerPhone,
                'customerAddress' => $customerAddress
            ]);

            if($count === 1){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer updated successfully'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Customer updated failed'
                ], 200);
            }
    }


    function deleteCustomer(Request $request){

        $userID = $request->header('userID');
        $customerID = $request->input('customerID');
        $count = Customer::where('id', $customerID)->where('user_id', $userID)->delete();
        if($count === 1){
            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer deleted failed'
            ], 200);
        }
    }


}

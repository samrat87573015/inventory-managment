<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{

    function productPage()
    {
        return view('pages.product.index');
    }

    function getProductList(Request $request){
        $userID = $request->header('userID');
        $productList = Product::where('user_id', $userID)->get();
        return $productList;
    }


    function getProductByID(Request $request){
        $userID = $request->header('userID');
        $productID = $request->input('productID');
        $product = Product::where('id', $productID)->where('user_id', $userID)->first();
        return $product;
    }

    function createProduct(Request $request){

        try{
            $userID = $request->header('userID');

            $img = $request->file('Image');

            $time = time();
            $imgFileName = $img->getClientOriginalName();
            $imgName = "{$userID}-{$time}-{$imgFileName}";

            $imgUrl = "uploads/{$imgName}";

            $img->move(public_path('uploads'), $imgName);


            Product::create([
                'productName' => $request->input('productName'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'productImageUrl' => $imgUrl,
                'user_id' => $userID,
                'category_id' => $request->input('category_id')
            ]);

            return response()->json([
                'status' => 'success',
                 'message' => 'Product Created Successfully'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Product Created Failed'
            ], 200);
        }

    }


    function updateProduct(Request $request){

        $userID = $request->header('userID');
        $productID = $request->input('productID');

        if($request->hasFile('Image')){

            $img = $request->file('Image');

            $time = time();
            $imgFileName = $img->getClientOriginalName();
            $imgName = "{$userID}-{$time}-{$imgFileName}";

            $imgUrl = "uploads/{$imgName}";
            $img->move(public_path('uploads'), $imgName);

            // delete old img
            $oldImgUrl = $request->input('oldImgUrl');
            File::delete($oldImgUrl);

            // update product

            return Product::where('id', $productID)->where('user_id', $userID)->update([
                'productName' => $request->input('productName'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'productImageUrl' => $imgUrl,
                'category_id' => $request->input('category_id')
            ]);


        }else{

            return Product::where('id', $productID)->where('user_id', $userID)->update([
                'productName' => $request->input('productName'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id')
            ]);
        }
    }


    function deleteProduct(Request $request){
        $userID = $request->header('userID');
        $productID = $request->input('productID');
        $oldImgUrl = $request->input('oldImgUrl');
        File::delete($oldImgUrl);
        $count = Product::where('id', $productID)->where('user_id', $userID)->delete();

        if($count === 1){
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Product deleted failed'
            ], 200);
        }

    }


}

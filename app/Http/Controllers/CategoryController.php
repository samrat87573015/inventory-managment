<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function categoryPage(){
        return view('pages.category.index');
    }


    function getCategoryList(Request $request){

        $userID = $request->header('userID');
        $categoryList= Category::where('user_id', $userID)->get();

        return $categoryList;

    }


    function createCategory(Request $request){

        try{
            $userID = $request->header('userID');
         
            Category::create([
                'categoryName' => $request->input('categoryName'),
                'user_id' => $userID
            ]);


            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully'
            ], 200);


        }catch(\Exception $e){

            return response()->json([
                'status' => 'failed',
                'message' => 'Category created failed'
            ], 200);
        }




    }

    function updateCategory(Request $request){
        $userID = $request->header('userID');
        $categoryID = $request->input('categoryID');
        $categoryName = $request->input('categoryName');

        $count = Category::where('id', $categoryID)->where('user_id', $userID)->update([
            'CategoryName' => $categoryName,
            'user_id' => $userID
        ]);

        if($count === 1){
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Category updated failed'
            ], 200);
        }
    }

    function deleteCategory(Request $request){

        $userID = $request->header('userID');
        $categoryID = $request->input('categoryID');
        $count = Category::where('id', $categoryID)->where('user_id', $userID)->delete();


        if($count === 1){
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Category deleted failed'
            ], 200);
        }
    }


    function getCategoryID(Request $request){

        $userID = $request->header('userID');
        $categoryID = $request->input('categoryID');
        $category = Category::where('id', $categoryID)->where('user_id', $userID)->first();
        return $category;
    }


}

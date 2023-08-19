<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    public function create(Request $request){

        $loggedInUser = Auth::user();
        $subcategory = Subcategory::create([
            'name'=>$request->name,
            'description' =>$request->description,
            'categoryId' =>$request->categoryId,
            'user_id' => $loggedInUser->id,
        ]);
        if($subcategory){
            return response()->json(['status'=>'success','message'=>'SubCategory Create Successfully','data'=>$subcategory]);
           }
           return response()->json(['status'=>'fail','message'=>'SubCategory Create fail']);
    }
}

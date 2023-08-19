<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request){

        $loggedInUser = Auth::user();
        $category = Category::create([
            'name'=>$request->name,
            'description' =>$request->description,
            'user_id' => $loggedInUser->id,

        ]);
        if($category){
            return response()->json(['status'=>'success','message'=>'Category Create Successfully','data'=>$category]);
           }
           return response()->json(['status'=>'fail','message'=>'Category Create fail']);
    }

    public function index(){
        $loggedInUser = Auth::user();
        $categories = Category::where([['status', 1], ['user_id' , $loggedInUser->id]])->get();

        return response()->json(['message'=>'All Categories ','data'=>$categories]);
    }

    public function show($id){
        $category = Category::where('id',$id)->first();
        return response()->json(['message'=>'Success ','data'=>$category]);
    }
}

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

    public function index(){

        $loggedInUser = Auth::user();
        $subcategories = Subcategory::where([['status', 1], ['user_id' , $loggedInUser->id]])->get();

        return response()->json(['message'=>'All Sub-Categories ','data'=>$subcategories]);
    }

    public function show($id){

        $subcategory = Subcategory::where('id',$id)->first();
        return response()->json(['message'=>'Success ','data'=>$subcategory]);
    }

    public function update(Request $req,$id){

        $user = Auth::user();
        $subcategory= Subcategory::where([['id', $id], ['user_id', $user->id]])->first();
        if($subcategory){
            $subcategory->update([
                'name' => $req->name ?? $subcategory->name,
                'description' => $req->description ?? $subcategory->description,
                'categoryId' => $req->categoryId ?? $subcategory->categoryId,
            ]);
        }
        if($subcategory){
            return response()->json(['status'=>'success','message'=>'Sub-Category Update Successfully','data'=>$subcategory]);
           }
           return response()->json(['status'=>'fail','message'=>'Sub-Category Update fail']);
    }

    public function destroy($id){

        $user = Auth::user();
        $subcategory = Subcategory::where([['id', $id], ['user_id', $user->id]])->first();
        if($subcategory){
            $subcategory->delete();
        }

        if($subcategory){
            return response()->json(['status'=>'success','message'=>'Sub-Category Deleted Successfully']);
           }
           return response()->json(['status'=>'fail','message'=>'Sub-Category Delete fail']);
    }
}

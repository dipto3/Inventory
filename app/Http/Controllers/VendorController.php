<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
   public function store(Request $request){

    $loggedInUser = Auth::user();
        $vendor = Vendor::create([

            'vendor'=>$request->vendor,
            'first_name' =>$request->first_name,
            'last_name' =>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'userId' => $loggedInUser->id,
            'zipCode'=>$request->zipCode,
            'emergencyContact_person '=>$request->emergencyContact_person,
            'emergencyContact_phone '=>$request->emergencyContact_phone,
            'emergencyContact_address '=>$request->emergencyContact_address,

        ]);
        if($vendor){
            return response()->json(['status'=>'success','message'=>'Vendor Create Successfully','data'=>$vendor]);
           }
           return response()->json(['status'=>'fail','message'=>'Vendor Create fail']);
   }

   public function index(){

    $loggedInUser = Auth::user();
    $categories = Vendor::where([['status', 1], ['userId' , $loggedInUser->id]])->get();

    return response()->json(['message'=>'All Categories ','data'=>$categories]);
}
}

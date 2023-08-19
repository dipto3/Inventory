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
    $vendors = Vendor::where([['status', 1], ['userId' , $loggedInUser->id]])->get();

    return response()->json(['message'=>'All Vendors ','data'=>$vendors]);
    }

    public function show($id){

        $vendor = Vendor::where('id',$id)->first();
        return response()->json(['message'=>'Success ','data'=>$vendor]);
    }

    public function update(Request $request){

        $user = Auth::user();
        $vendor= Vendor::where([['id', $request->id], ['userId', $user->id]])->first();
        if($vendor){
            $vendor->update([
                'vendor'=>$request->vendor ?? $vendor->vendor,
                'first_name' =>$request->first_name ??$vendor->first_name,
                'last_name' =>$request->last_name ??$vendor->last_name,
                'email'=>$request->email ??$vendor->email,
                'phone'=>$request->phone ??$vendor->phone,
                'userId' => $user->id ??$vendor->userId,
                'zipCode'=>$request->zipCode ??$vendor->zipCode,
                'emergencyContact_person '=>$request->emergencyContact_person ??$vendor->emergencyContact_person,
                'emergencyContact_phone '=>$request->emergencyContact_phone ??$vendor->emergencyContact_phone,
                'emergencyContact_address '=>$request->emergencyContact_address ??$vendor->emergencyContact_address,
            ]);
        }
        if($vendor){
            return response()->json(['status'=>'success','message'=>'Vendor Update Successfully','data'=>$vendor]);
           }
           return response()->json(['status'=>'fail','message'=>'Vendor Update fail']);
    }

    public function destroy($id){

        $user = Auth::user();
        $vendor = Vendor::where([['id', $id], ['userId', $user->id]])->first();
        if($vendor){
            $vendor->delete();
        }

        if($vendor){
            return response()->json(['status'=>'success','message'=>'vendor Deleted Successfully']);
           }
           return response()->json(['status'=>'fail','message'=>'vendor Delete fail']);
    }



}

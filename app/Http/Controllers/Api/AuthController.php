<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use App\Notifications\EmailVerificationNotification;

class AuthController extends Controller
{
    public function register(Request $request){

        $input = $request->all();
        $input['password']=bcrypt($input['password']);
        $user = User::Create($input);

        event(new Registered($user));

        $success["token"] =$user->createToken('user')->plainTextToken;
        $success["name"] =$user->name;
        $user->notify(new EmailVerificationNotification());
        if($user){
            return response()->json(['status'=>'success','message'=>'User Create Successfully','data'=>$user,'token'=>$success]);
           }
           return response()->json(['status'=>'fail','message'=>'User Create fail']);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        // $validation = Validator::make($input,
        // [
        //     'email'=>'required|email',
        //     'password'=>'required'
        // ]);

        // if($validation->fails()){
        //      return response()->json(['errors'=>$validation->errors()->all()]);
        // }

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $token['token'] = $user->createToken('usertoken')->plainTextToken;

            return response()->json(['status'=>'success','login'=>true,'token'=>$token, 'data'=>$user]);
        }else{
            return response()->json(['status'=>'fail','message'=>'fails']);
        }
    }
}

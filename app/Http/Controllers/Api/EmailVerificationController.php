<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\EmailVerificationRequest;
use Otp;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;

class EmailVerificationController extends Controller
{
    private $otp;

    public function __construct(){
        $this->otp = new Otp;
    }

    public function sendEmailVerification(Request $request){
        $request->user()->notify(new EmailVerificationNotification());
        $success['success'] = true;
        return response()->json($success,200);
    }

    public function email_verification(EmailVerificationRequest $request){

        $otp2 = $this->otp->validate($request->email,$request->otp);

        if(!$otp2){
            return response()->json(['error'=>$otp2],401);
        }

        $user = User::where('email',$request->email)->update(['email_verified_at'=> now()]);

        if($user)return response()->json(["Message" => 'OTP updated']);
        else return response()->json(["Message" => 'OTP failed to update']);

    }

}

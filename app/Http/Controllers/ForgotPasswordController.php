<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\AssadMail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.password.sendEmailLinks');
    }
    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {   
        // return response()->json(['request'=> $request]);
        $user =  User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('loginPage')->with(['error' => "Invalid User. Please login or Create Account again."]);
        }
        if ($user) {
            $user->forgot_pass_token = rand(100, 999);
            if ($user->save()) {
                if ($request->route()->getPrefix() == 'api') {
                    $api = "api";
                } else {
                    $api = null;
                }
                Mail::to($user->email)->send(new ResetPasswordMail($user, $api));
                if ($api) {
                    return response()->json('check your email');
                }
                return redirect()->route('loginPage')->with(['success' => 'check your email.']);
            }
            return redirect()->route('loginPage')->with(['success' => 'Password reset Email is sent to your email.']);
        }
    }
}

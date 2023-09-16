<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showResetForm($user)
    {
        // return $user;
        // return redirect()->route('showRestForm',$user);
        return view('auth.password.reset-Password-Form', ['user' => $user]);
    }

    public function resetPassword(ResetPasswordRequest $request, $token = null)
    {
        $user = User::where('forgot_pass_token', $token)->first();
        // if ($user) {
        //     return response()->json(['user' => $user]);
        // } else {
        //     return response()->json(['error' => 'User not found'], 404);
        // }
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->forgot_pass_token = null;

            if ($user->save()) {
                if ($request->route()->getPrefix() == 'api') {
                    return response()->json(['message' => 'Password changed successfully.']);
                } else {
                    return redirect()->route('loginPage')->with(['success' => "Password changed successfully. Now you can log in!"]);
                }
            }
        }

        if ($request->route()->getPrefix() == 'api') {
            return response()->json(['error' => 'Password not changed. Please retry.'], 500);
        } else {
            return redirect()->back()->with(['error' => "Password not changed. Please retry."]);
        }

        // $user = User::where('forgot_pass_token', $token)->first();
        // if ($user) {
        //     $user->password = Hash::make($request->password);
        //     $user->forgot_pass_token = null;
        //     if ($user->save())
        //         return redirect()->route('loginPage')->with(['success' => "password changed now login!"]);
        // }
        // return redirect()->back()->with(['erorr' => "Password not changed retry."]);
    }
}

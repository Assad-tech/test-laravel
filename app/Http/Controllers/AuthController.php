<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VerifyTokenRequest;
use App\Mail\AssadMail;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function registerProcess(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->remember_token = rand(100, 999);
        $user->role_id = 3;
        if ($user->save()) {
            if ($request->route()->getPrefix() == 'api') {
                $api = "api";
            } else {
                $api = null;
            }
            Mail::to($user->email)->send(new AssadMail($user, $api));
            if ($api) {
                return response()->json('check your email');
            }
            return redirect()->route('loginPage')->with(['success' => 'check your email.']);
        }
    }
    public function emaiVerify(VerifyTokenRequest $request, $token = null)
    {
        if (!$token) {
            $userToken = User::where('remember_token', $request->token)->where('email', $request->email)->first();
        } else {
            $userToken = User::where('remember_token', $token)->first();
        }
        if ($userToken) {
            $userToken->remember_token = null;
            $userToken->email_verified_at = now();
            if ($userToken->save()) {
                $message = 'Email Verified, login now';
                if ($request->route()->getPrefix() == 'api') {
                    return response()->json(['message' => $message], 200);
                } else {

                    return redirect()->route('loginPage')->with(['success' => $message]);
                }
            }
        }
        if ($request->route()->getPrefix() == 'api') {
            return response()->json(['error' => "Something went wrong"], 400);
        } else {
            return redirect()->route('loginPage')->with(['error' => "Something went wrong"]);
        }
    }

    public function login()
    {
        return view('auth/login');
    }


    public function loginProcess(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('loginPage')->with(['error' => 'User not found']);
        }

        if ($user->email_verified_at == null) {
            if ($request->route()->getPrefix() == 'api') {
                return response()->json('Email Not Verified! check your email');
            } else {
                return redirect()->route('loginPage')->with(['error' => 'Email not Verified. Please verify email!']);
            }
        } elseif ($user->remember_token == null) {
            if (Hash::check($password, $user->password)) {
                if ($request->route()->getPrefix() == 'api') {
                    $token = $user->createToken('api_token')->plainTextToken;
                    $user->asad_token = $token;
                    if ($user->role_id == 1) {
                        return response()->json(['message' => 'You are loged in as Admin', 'user' => $user]);
                    }
                    return response()->json(['message' => 'You are loged in as User', 'user' => $user]);
                } else {
                    session()->put('user', $user->id);
                    // return $user;
                    if ($user->role_id == 1) {
                        return redirect()->route('AdminDashboard');
                    } elseif ($user->role_id == 2) {
                        return redirect()->route('v-AdminDashboard');
                    }
                    return redirect()->route('UserDashboard');
                }
            } else {
                return redirect()->route('loginPage')->with(['error' => 'Incorrect password']);
            }
        }
    }



    public function logout(Request $request)
    {
        $user = $request->user();
        if ($request->route()->getPrefix() == 'api') { //API File
            $token = \DB::table('personal_access_tokens')
                ->where('tokenable_id', $user->id)
                ->where('expires_at', null) // Compare with current date and time
                ->latest()->first();

            if ($token) {
                $updatedToken = \DB::table('personal_access_tokens')
                    ->where('id', $token->id)
                    ->update(['expires_at' => now()]);

                if ($updatedToken) {
                    return response()->json(['message' => 'Logout successfully']);
                } else {
                    return response()->json(['message' => 'Failed to update token expiration'], 500);
                }
            } else {
                return response()->json(['message' => 'Token not found or already expired'], 404);
            }
        } else { //Blade File
            $user_id = session()->get('user');
            if ($user_id) {
                session()->forget('user'); // Remove user from the session
            }
            return redirect()->route('loginPage'); // Redirect to your desired page after logout
        }
    }
}

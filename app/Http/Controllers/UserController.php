<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VerifyTokenRequest;
use App\Mail\AssadMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::get();
        if (request()->route()->getPrefix() == 'api' || request()->route()->getPrefix() == 'api/') {
            $user = $request->user();
            if ($user->role_id == 1 || $user->role_id == 1) {
                return response()->json(['users' => $users, 'Role' => 1], 200);
            } elseif ($user->role_id == 2) {
                return response()->json(['users' => $users, 'Role' => 2], 200);
            }
            return response()->json(['users' => $users], 200);
        } else {
            $user = $request->user;
            if ($user->role_id == 1) {
                return view('admin/admin-dashboard', ['users' => $users]);
            } elseif ($user->role_id == 2) {
                return view('v-admin.v-admin-dashboard', ['users' => $users]);
            }
            return view('user/user-dashboard');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = request()->user;
        if ($user->role_id == 1) {
            return view('admin.createUser');
        } elseif ($user->role_id == 2) {
            return view('v-admin/createUser');
        }
        return view('user.user-dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $userRole = request()->user;
        $user =  new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->remember_token = rand(100, 999);
        $user->role_id = 3;
        $user->posted_by = $userRole->id;
        if ($user->save()) {
            if ($request->route()->getPrefix() == 'api') {
                $api = "api";
            } else {
                $api = null;
            }
            Mail::to($user->email)->send(new AssadMail($user, $api));
            if ($api) {
                return response()->json('check your email');
            } else {
                if ($userRole->role_id == 1) {
                    return redirect()->route('AdminDashboard')->with(['success' => 'check users email.']);
                }
                return redirect()->route('v-AdminDashboard')->with(['success' => 'check users email.']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userRole = request()->user;
        $user = User::findOrFail($id);

        if ($userRole->role_id == 1) {
            return view('admin.edit-user', ['user' => $user]);
        } elseif ($userRole->role_id == 2) {
            return view('v-admin.edit-user', ['user' => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $getUser = User::findOrFail($id);
        $getUser->name = $request->input('name', $getUser->name);
        $check =(request()->route()->getPrefix() == 'api' ||request()->route()->getPrefix() == 'api/');
        if ($getUser->save()){
            return $getUser;
            if ($check) {
                    $user = request()->user();
                    if ($user->role_id == 1 || $user->role_id ==2)
                    return response()->json('User Updated Successfuly!', 200);
            }else{
                $user = $request->user;
                $arraySuccess = ['message' => 'User Updated Successfuly!'];
                if ($user->role_id == 1)
                return redirect()->route('AdminDashboard')->with($arraySuccess);
                elseif ($user->role_id ==2)
                return redirect()->route('v-AdminDashboard')->with($arraySuccess);
            }
        }
        $arrayError = ['message'=>'update error'];
        if($check){
            return response()->json($arrayError, 200);

        } else{
            return redirect()->route('v-AdminDashboard')->with($arrayError);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id)->delete();
        if (request()->route()->getPrefix() == 'api' || request()->route()->getPrefix() == 'api/') {
            $user = $request->user();
            if ($user->role_id == 1) {
                return response()->json('yes i dont it!');
            } else {
                return response()->json('yes i dont it!');
            }
        }
        if($user){
            if($user->role_id ==1){
                return redirect()->route('AdminDashboard')->with(['messsage' => 'User Deleted.']);
            }else{
                return redirect()->route('v-AdminDashboard')->with(['messsage' => 'User Deleted.']);
                
            }
        }
        return back()->with(['message' => 'Error in delete']);
    }
}

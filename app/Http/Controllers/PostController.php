<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Posts;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = session()->get('user');
        $posts = Posts::where('user_id', $id)->get();
        $user = request()->user;
        if ($user->role_id == 1) {
            return view('post', ['posts' => $posts]);
        } elseif ($user->role_id == 2) {
            return view('post', ['posts' => $posts]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = request()->user;
        if ($user->role_id == 1) {
            return view('createPost');
        } elseif ($user->role_id == 2) {
            return view('createPost');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // return $request;
        $userRole = request()->user;
        $post =  new Posts();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $userRole->id;
        if ($post->save()) {
            if ($request->route()->getPrefix() == 'api') {
                $api = "api";
            } else {
                $api = null;
            }
            if ($api) {
                return response()->json('Your Content is Posted');
            } else {
                if ($userRole->role_id == 1) {
                    return redirect()->route('AdminDashboard')->with(['success' => 'Content Posted']);
                }
                return redirect()->route('v-AdminDashboard')->with(['success' => 'Content Posted']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userRole = request()->user;
        $post = Posts::findOrFail($id);

        if ($userRole->role_id == 1) {
            return view('show-post', ['post' => $post]);
        } elseif ($userRole->role_id == 2) {
            return view('show-post', ['post' => $post]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userRole = request()->user;
        $post = Posts::findOrFail($id);

        if ($userRole->role_id == 1) {
            return view('edit-post', ['post' => $post]);
        } elseif ($userRole->role_id == 2) {
            return view('edit-post', ['post' => $post]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $userRole = request()->user->role_id;
        $post = Posts::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        if ($post->save()) {
            if ($userRole == 1) {
                return redirect()->route('AdminDashboard')->with(['message' => 'Post Updated Successfuly!']);
            } elseif ($userRole == 2) {
                return redirect()->route('v-AdminDashboard')->with(['message' => 'Post Updated Successfuly!']);
            }
        } else {
            if ($userRole == 1) {
                return redirect()->route('AdminDashboard')->with(['message' => 'something fishi fishi']);
            } elseif ($userRole == 2) {
                return redirect()->route('v-AdminDashboard')->with(['message' => 'something fishi fishi']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userRole = request()->user->role_id;
        $post = Posts::findOrFail($id);
        if ($post->delete()) {
            if ($userRole == 1) {
                return redirect()->route('AdminDashboard')->with(['success' => 'Post Deleted Successfuly!']);
            } elseif ($userRole == 2) {
                return redirect()->route('v-AdminDashboard')->with(['success' => 'Post Deleted Successfuly!']);
            }
        } else {
            if ($userRole == 1) {
                return redirect()->route('AdminDashboard')->with(['error' => 'something fishi fishi']);
            } elseif ($userRole == 2) {
                return redirect()->route('v-AdminDashboard')->with(['error' => 'something fishi fishi']);
            }
        }
    }
}

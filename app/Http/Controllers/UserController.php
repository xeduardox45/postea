<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('userEdit',['user' => User::find($id) ]);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        $usuario->update();

        return redirect('/home');
    }

    public function destroy(user $user)
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->get();
        foreach ($posts as $post) {
            $post->delete();
        }
        
        $user->delete();
        return redirect('/home');
    }

    public function showNotifications($id)
    {
        $user = User::find($id);
        return view('notifications.notification', ['notifications'=> $user->notifications]);
    }
}

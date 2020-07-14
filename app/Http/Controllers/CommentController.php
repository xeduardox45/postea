<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\InvoicePaid;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required:max:250',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->content = $request->get('content');

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        $user = User::find($post->user_id);
        $user->notify(new InvoicePaid($comment, $post));

        //return dd( $user->notify(new InvoicePaid($comment, $post)));
        return redirect()->route('post',['id' => $request->get('post_id')]);
    }
}

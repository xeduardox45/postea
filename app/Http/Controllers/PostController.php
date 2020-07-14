<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function index()
    {
        //NOTA: No se llegó a encontrar una solución para este detalle.
        /*
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->get();
        return view('posts.myPosts', compact('posts'));
        */
        
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function createView()
    {
        return view('posts.create');
    }

    public function show($id)
    {
        return view('posts.postUnico', ['post' => Post::find($id)]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required:max:120',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required:max:2200',
        ]);

        $imageName = Storage::disk('public')->putFile('posts/'. Auth::id(), $request->file('image'));
        $title = $request->get('title');
        $content = $request->get('content');

        $post = $request->user()->posts()->create([
            'title' => $title,
            'image' => $imageName,
            'content' => $content,
        ]);

        return redirect()->route('post', ['id' => $post->id]);
    }

    public function userPosts()
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->get();
        return view('posts.index', compact('posts'));
    }

    public function destroy(post $post)
    {
        $post->delete();
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->get();
        return view('posts.index', compact('posts'));
    }

    public function today()
    {
        //Primero obtenemos la fecha actual del servidor:
        $now = new \DateTime();
        //Entonces lo adecuamos a un formato conveniente para que solo nos muestre el día de la fecha actual:
        $dia_now = strval($now->format('d'));
        //Integramos todos los posts existentes a la variable "posts":
        $posts = Post::all();
        //Creamos un array de nombre "today_posts", el cual se encargará de almacenar los posts que se crearon en el día:
        $today_posts=array();
        /*A continuación, empezamos a consultar post por post para escoger aquellos que se han creado el día de hoy
        comparando su día de creación con el día actual del servidor, y guardamos estos posts en el array creado anteriormente*/
        foreach ($posts as $post) {
            $dia_post = $post->created_at;
            $dia_post = $dia_post->format('d');
            if($dia_post==$dia_now){
                array_push($today_posts, $post);
            }
        }
        //Entonces retornamos la vista "today" con los posts que se crearon durante el día actual del servidor:
        return view('today', compact('today_posts'));

    }
}
@extends('layouts.app')

@section('content')
<div class="container">
@auth
  {{--Con la siguiente etiqueta es que creamos el botón--}}
  <button class="btn btn-dark" type=submit><a href="{{action('PostController@userPosts')}}">Revisar mis publicaciones</a></button>
  <button class="btn btn-dark" type=submit><a href="{{action('PostController@create')}}">Crear nueva publicación</a></button>
@endauth
  <button class="btn btn-dark" type=submit><a href="{{action('PostController@today')}}">Revisar las publicaciones que se crearon hoy</a></button>
  
  @foreach ($posts as $post)
  <div class="row mb-4 justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                <a href="{{action('PostController@show',$post->id)}}">{{$post->title}}</a>
            </h5>
          </div>
          <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="...">
        </div>
    </div>
  </div>
  @endforeach
  {{ $posts->links()}}
</div>
@endsection

</body>
</html>
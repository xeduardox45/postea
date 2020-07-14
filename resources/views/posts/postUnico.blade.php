{{--Extendemos desde la plantilla app para establecer el manejo de sesiones de usuario en todo momento de uso del aplicativo: --}}
@extends('layouts.app')
{{--Establecemos lo que se irá a mostrar en la página con el uso de la etiqueta section: --}}
@section('content')
{{--Creamos todos los contenedores y recuadros para soportar toda la información consultada como imagenes, títulos y texto: --}}
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
          <img src="{{ Storage::url($post->image) }}" class="card-ima-top" alt="...">
          <div class="card-body">
            <h3 class="card-title">{{$post->title}}</h3>
            <h6 class="card-subtitle mb-2 text-muted">{{$post->created_at->toFormattedDateString() }}</h6>
            <p class="card-text">{{$post->content}}</p>
            <a href="{{action('PostController@index')}}" class="card-link">Todas las publicaciones</a>
          </div>
        </div>
        @auth
          <form action="{{ action('CommentController@store', ['post_id' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="col-sm-2 col-form-label" for="content">{{ __('Comment') }}
</label>
              <div class="col-sm-12">
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3">{{ old('content') }}</textarea>
                @error('content')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message  }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">
                  {{ __('Create') }}
                </button>
              </div>
            </div>
          </form>
        @endauth
        @guest
          <p>Si deseas comentar <a href="{{ action('Auth\LoginController@showLoginForm') }}">inicia sesión</a> o <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}">registrate</a></p>
        @endguest
        @forelse ($post->comments as $comment)
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $comment->user->name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at->toFormattedDateString() }}</h6>
              <p class="card-text">{{ $comment->content }}</p>
            </div>
          </div>
        @empty
          <p>No hay comentarios para esta publicacion, se el primero</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection

</body>
</html>
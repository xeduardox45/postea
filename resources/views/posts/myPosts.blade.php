@extends('layouts.app')

@section('content')
<div class="container">
  @foreach ($posts as $post)
  <div class="row mb-4 justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
                <h5>
                    <a href="{{action('PostController@show',$post->id)}}">{{$post->title}}</a>
                </h5>
                {{-- En esta parte diseñas el botón, el cual nos lleva a la ruta de nombre post.destroy manteniendo la información necesaria del post para borrarla --}}
                <form method="POST" action="{{ route('post.destroy', $post)}}">
                    @csrf @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
          </div>
          <img src="{{asset($post->image)}}" class="card-img-top" alt="...">
        </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

</body>
</html>
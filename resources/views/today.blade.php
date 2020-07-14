@extends('layouts.app')

@section('content')
<div class="container">
  @if($today_posts==null)
    <h2>No se ha agregado ningún post el día de hoy.</h2>
  @endif
  @foreach ($today_posts as $post)
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
</div>
@endsection

</body>
</html>
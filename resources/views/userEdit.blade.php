@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Editar usuario {{$user->name}}</h2>
        </div>
        <div class="row justify-content-center">
            @if (count($errors) > 0)
            <div class="row alert alert-danger">
            <p>!Opss! Hubo problemas con los datos proporcionados</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <l1>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Creamos el formulario para la edición. Este formulario envía a la ruta "users.update" cuando se hace click en el botón "Guardar cambios": --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Escribe tu nombre">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Escribe tu email">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
    <p></p>
    <div class="row justify-content-center">
        {{-- En este formulario agregamos la opción de eliminar usuario: --}}
            <form method="POST" action="{{ route('users.destroy', $user)}}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
            </form>
    </div>
</div>
@endsection
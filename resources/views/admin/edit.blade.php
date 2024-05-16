<!-- resources/views/admin/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Médico</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.update', $medico->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $medico->name) }}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $medico->email) }}" required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

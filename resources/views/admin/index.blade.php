@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Bienvenido, {{ Auth::user()->name }}</p>
    <a href="{{ route('medicos.index') }}" class="btn btn-primary">Gestionar Médicos</a>
</div>
@endsection

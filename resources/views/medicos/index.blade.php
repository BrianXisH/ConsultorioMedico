@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Medico Dashboard</h1>
    <p>Bienvenido, {{ Auth::user()->name }}</p>
    <!-- Aquí puedes añadir más contenido para el dashboard del médico -->
</div>
@endsection

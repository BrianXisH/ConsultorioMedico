<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Administrador</div>

                <div class="card-body">
                    Bienvenido, administrador!
                        <br>
                    <a href="{{ route('admin.medicos.index') }}" class="btn btn-primary">Ver Médicos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
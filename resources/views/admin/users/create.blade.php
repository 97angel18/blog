@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos Personales</h3>
            </div>
            <div class="card-body">
                @include('partials.error-messages')
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles">Roles:</label>
                                @include('admin.roles.checkboxes')
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permisos">Permisos:</label>
                                @include('admin.permissions.checkboxes',['model' => $user])
                            </div>
                        </div>
                    </div>
                    <span class="help-block">La contraseña sera generada y enviada al nuevo usuario via email </span>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">Crear usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

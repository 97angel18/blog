@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"> Datos Personales</h3>
            </div>
            <div class="card-body">
                @include('partials.error-messages')
                <form action="{{ route('admin.users.update',$user) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" value="{{ old('name',$user->name) }}"
                            class="form-control @error('name') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="{{ old('email',$user->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                        <span class="text-danger">Dejar en blanco para no cambiar la contraseña </span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Repite la contraseña:</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Repite la contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar usuario</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                @role('Admin')
                <form action="{{ route('admin.users.roles.update',$user) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @include('admin.roles.checkboxes')
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar roles</button>
                </form>
                @else
                    <ul class="list-group">
                        @forelse ($user->roles as $role)
                            <li class="list-group-item">{{ $role->name }}</li>
                        @empty
                            <li class="list-group-item">No tiene ningun role</li>
                        @endforelse
                    </ul>
                @endrole
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                @role('Admin')
                <form action="{{ route('admin.users.permissions.update',$user) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @include('admin.permissions.checkboxes',['model' => $user])
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar permisos</button>
                </form>
                @else
                <ul class="list-group">
                    @forelse ($user->permissions as $permission)
                        <li class="list-group-item">{{ $permission->name }}</li>
                    @empty
                        <li class="list-group-item">No tiene permisos</li>
                    @endforelse
                </ul>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection

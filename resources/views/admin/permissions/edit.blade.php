@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Actualizar Permiso</h3>
            </div>
            <div class="card-body">
                @include('partials.error-messages')
                <form action="{{ route('admin.permissions.update',$permission) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Identicador:</label>
                        <input value="{{ $permission->name }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="display_name">Nombre:</label>
                        <input type="text" name="display_name" value="{{ old('display_name',$permission->display_name) }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar Permiso</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Crear Role</h3>
            </div>
            <div class="card-body">
                @include('partials.error-messages')
                <form action="{{ route('admin.roles.update',$role) }}" method="POST">
                    @method('PUT')
                    @include('admin.roles.form')
                    <button type="submit" class="btn btn-primary btn-block">Actualizar Role</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

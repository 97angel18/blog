@csrf
<div class="form-group">
    <label for="name" class="col-form-label">Identificador:</label>
    @if($role->exists)
        <input class="form-control" value="{{ $role->name }}" disabled>
    @else
        <input name="name" value="{{ old('name',$role->name) }}" class="form-control">
    @endif
</div>
<div class="form-group">
    <label for="display_name" class="col-form-label">Nombre:</label>
    <input name="display_name" type="text" class="form-control" value="{{ old('display_name',$role->display_name) }}">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="permisos">Permisos:</label>
            @include('admin.permissions.checkboxes',['model' => $role])
        </div>
    </div>
</div>

@foreach ($permissions as $id => $name)
<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="permissions[]" type="checkbox" id="customCheckbox{{ $name }}"
        value="{{ $name }}" {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($name) ? 'checked' : '' }}>
    <label for="customCheckbox{{ $name }}" class="custom-control-label">{{ $name }}</label>
</div>
@endforeach

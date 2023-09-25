@foreach ($roles as $role)
<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="roles[]" type="checkbox" id="customCheckbox{{ $role->name }}"
        value="{{ $role->name }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
    <label for="customCheckbox{{ $role->name }}" class="custom-control-label">{{ $role->name }}</label><br>
    <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
</div>
@endforeach

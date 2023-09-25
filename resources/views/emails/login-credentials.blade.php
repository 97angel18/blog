<x-mail::message>
# Tus credenciales para acceder {{ config('app.name') }}

Utiliza estas credenciales para acceder al sistema.
<x-mail::table>
    | Username | Contraseña |
    |:----------|:------------|
    |{{ $user->email }}|{{ $password }}
</x-mail::table>
<x-mail::button :url="url('login')">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ setActiveRoute('admin')}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Inicio </p>
            </a>
        </li>
        <li class="nav-item {{ setActiveMenu('admin/posts*') }}">
            <a href="#" class="nav-link {{ setActiveCreate('admin/posts*') }}">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ setActiveRoute('admin.posts.index')}}">
                            <i class="far fa-eye nav-icon"></i>
                            <p>Ver todos los posts</p>
                        </a>
                    </li>
                @can('create', new App\Models\Post)
                    <li class="nav-item">
                        @if(request()->is('admin/posts/*'))
                        <a href="{{ route('admin.posts.index','#create') }}" class="nav-link {{ setActiveRoute('admin.posts.edit')}}">
                            <i class="fas fa-pencil-alt nav-icon"></i>
                            <p>Crear un post</p>
                        </a>
                        @else
                        <a href="#" class="nav-link {{ setActiveRoute('admin.posts.edit')}}" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-pencil-alt nav-icon"></i>
                            <p>Crear un post</p>
                        </a>
                        @endif
                    </li>
                @endcan
            </ul>

        </li>
        @can('view',new App\Models\User)
            <li class="nav-item {{ setActiveMenu('admin/users*') }}">
                <a href="#" class="nav-link {{ setActiveCreate('admin/users*') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index')}}">
                            <i class="far fa-eye nav-icon"></i>
                            <p>Ver todos los usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.create') }}" class="nav-link {{ setActiveCreate('admin/users/*')}}">
                            <i class="fas fa-pencil-alt nav-icon"></i>
                            <p>Crear un usuario</p>
                        </a>
                    </li>
                </ul>
            </li>
        @else
        <li class="nav-item">
            <a href="{{ route('admin.users.show',Auth::user()) }}" class="nav-link {{ setActiveRoute(['admin.users.edit','admin.users.show'])}}">
                <i class="nav-icon fas fa-user"></i>
                <p> Perfil </p>
            </a>
        </li>
        @endcan
        @can('view', new \Spatie\Permission\Models\Role)
            <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ setActiveRoute(['admin.roles.index','admin.roles.edit'])}}">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    <p> Roles </p>
                </a>
            </li>
        @endcan
        @can('view', new \Spatie\Permission\Models\Permission)
            <li class="nav-item">
                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ setActiveRoute(['admin.permissions.index','admin.permissions.edit'])}}">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    <p> Permisos </p>
                </a>
            </li>
        @endcan
    </ul>
</nav>
<!-- /.sidebar-menu -->

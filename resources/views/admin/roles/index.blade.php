@extends('admin.layout')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de Roles </h3>
            @can('create', $roles->first())
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Crear Role</a>
            @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="roles_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Permisos</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $roles  as $role )
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->permissions->pluck('display_name')->implode(', ') }}</td>
                    <td>
                        @can('update', $role)
                        <a href="{{ route('admin.roles.edit',$role) }}" class="btn btn-xs btn-info"><i class="fas fa-pencil-alt"></i></a>
                        @endcan
                        @can('delete',$role)
                            @if($role->id !== 1)
                            <form action="{{ route('admin.roles.destroy',$role) }}" method="POST" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este Role?')"><i class="fa fa-times"></i></button>
                            </form>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tfoot>
    </table>
    </div>
    <!-- /.card-body -->
</div>

@stop
@push('styles')
        <!-- DataTables -->
        <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@push('scripts')

<!-- DataTables  & Plugins -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#roles_table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", {
            extend: 'excel',
            exportOptions: {
                    columns: ':visible',
                }
        }, "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#roles_table_wrapper .col-md-6:eq(0)');
    });
  </script>
@endpush

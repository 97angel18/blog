@extends('admin.layout')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Permisos</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de Permisos </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="permissions_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $permissions  as $permission )
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->display_name }}</td>
                    @can('update', $permission)
                    <td>
                        <a href="{{ route('admin.permissions.edit',$permission) }}" class="btn btn-xs btn-info"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    @endcan
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
      $("#permissions_table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", {
            extend: 'excel',
            exportOptions: {
                    columns: ':visible',
                }
        }, "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#permissions_table_wrapper .col-md-6:eq(0)');
    });
  </script>
@endpush

@extends('admin.layout')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Posts</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop
@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Listado de publicaciones </h3>´
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Crear Publicación</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="posts_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Extracto</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $posts  as $post )
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->excerpt }}</td>
                    <td>
                        <a href="{{ route('posts.show',$post) }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-xs btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('admin.posts.destroy',$post) }}" method="POST" style="display: inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta publicación?')"><i class="fa fa-times"></i></button>
                        </form>
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
      $("#posts_table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", {
            extend: 'excel',
            exportOptions: {
                    columns: ':visible',
                }
        }, "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#posts_table_wrapper .col-md-6:eq(0)');
    });
  </script>
@endpush

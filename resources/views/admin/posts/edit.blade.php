@extends('admin.layout')
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Crear publicacion</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop
@section('content')
@if ($post->photos->count())
<div class="card">
    <div class="card-header">
        <label class="card-title">Imágenes de la publicación</label>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($post->photos as $photo)
            <div class="col-md-2">
                    <form action="{{ route('admin.photos.destroy',$photo) }}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button type="submit" class="btn btn-danger btn-xs" style="position: absolute"><i class="fas fa-times"></i></button>
                    <img class="img-fluid mb-3" src="{{ Storage::url($photo->url) }}" alt="">
                    </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="card">
    <form action="{{ route('admin.posts.update',$post) }}" method="POST" >
        @csrf
        @method('PUT')
    <div class="row card-body">
        <div class="col-6">
            <div class="form-group">
                <label>Titulo de la publicación</label>
                <input type="text" name="title"  value="{{ old('title',$post->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Ingresa aqui el titulo de la publicación">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Extracto de la publicación</label>
                <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt',$post->excerpt) }}</textarea>
                @error('excerpt')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Contenido de la publicación</label>
                <textarea id="summernote" name="body" rows="7" class="form-control @error('body') is-invalid @enderror">{{ old('body',$post->body) }}</textarea>
                @error('body')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Contenido embebido (iframe)</label>
                <textarea id="summernote" name="iframe" rows="4" class="form-control @error('iframe') is-invalid @enderror" placeholder="Ingresa contenido embebido (iframe) de audio o video">{{ old('iframe',$post->iframe) }}</textarea>
                @error('iframe')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <div class="select2-danger">
                    <label>Categorías: </label>
                        <select class="form-control select2 select2-danger @error('category_id') is-invalid @enderror" name="category_id" id="category"  multiple="multiple" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id',$post->category_id)== $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Etiquetas: </label>
                <div class="select2-purple">
                    <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione una etiqueta" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <option value="">Seleccione una Etiqueta</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} >{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Date and time -->
            <div class="form-group">
                <label>Fecha de publicación:</label>
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text">
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                        </div>
                        <input name="published_at" id="published_at" type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" value="{{ old('published_at',$post->published_at) }}" />
                </div>
            </div>

            <!--Dropzone-->
            <div class="form-group">
                <label>Imagenes de la publicación</label>
                <div class="dropzone">

                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-xl btn-primary">Enviar</button>
        </div>
    </div>
</form>
</div>

@stop

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Dropzone.js -->
<!-- summernote -->
<link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
@endpush
@push('scripts')
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

<script src="/adminlte/plugins/select2/js/i18n/es.js"></script>
<!-- Summernote -->
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Dropzone.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
$(function (){

    //summernote
$('#summernote').summernote({
  height: 150,   //set editable area's height
  codemirror: { // codemirror options
    theme: 'monokai'
  },
  placeholder: "Ingresa el contenido de la publicación",
  image : false,
})
$('.note-group-select-from-files').first().remove()

    //datepicker
    $('#reservationdatetime').datetimepicker({
        format: "YYYY/MM/DD h:mm:ss a",
    });

    //Initialize Select2 Elements
    $('.select2').select2({
        tags : true
    })
    $('#category').select2({
        maximumSelectionLength: 1,
        language: "es"
    })
})

</script>
<script>
    let myDropzone = new Dropzone('.dropzone',{
        url: '/admin/posts/{{ $post->url }}/photos',
        paramName: 'photo',
        acceptedFiles: 'image/*',
        maxFilesize: 2,
        // maxFiles: 'cantidad de archivos a suvir'
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dictDefaultMessage: 'Arrastra las imágens aquí para subirlas',

    });
    myDropzone.on('error', function (file, res) {
        var msg = res.errors.photo[0];
        $('.dz-error-message:last > span ').text(msg)
    })
    Dropzone.autoDiscover = false
</script>
@endpush

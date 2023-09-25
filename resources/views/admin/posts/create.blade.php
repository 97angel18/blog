<div class="modal fade" id="modal-default">
    <form action="{{ route('admin.posts.store','#create') }}" method="POST" >
        @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agrega el titulo de tu nueva publicación</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Titulo de la publicación</label>
                <input type="text" name="title" id="post-title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Ingresa aqui el titulo de la publicación" autofocus required>
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Crear publicación</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
  </div>

@push('scripts')
<script>

    if(window.location.hash === '#create')
    {
        $('#modal-default').modal('show');
    }
    $('#modal-default').on('hide.bs.modal',function(){
        window.location.hash = '#';
    })
    $('#modal-default').on('shown.bs.modal',function(){
        $('#post-title').focus();
        window.location.hash = '#create';
    })
</script>
@endpush

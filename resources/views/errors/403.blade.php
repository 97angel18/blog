@extends('layout')

@section('content')
    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Página NO autorizada</h1>
            <span style="color: red"> {{ $exception->getMessage() }} </span>
            <p>Regresar a <a href="{{ url()->previous() }}"> Regresar </a></p>
        </div>
    </section>
@endsection

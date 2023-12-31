@extends('layout')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@section('meta-title',$post->title)
@section('meta-description',$post->excerpt)

@section('content')
<article class="post container">
    @include($post->viewType())
    <div class="content-post">
        @include('posts.header')

        <h1> {{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
            <figure class="block-left"><img src="" alt=""></figure>
            <div>
                {!! $post->body !!}
            </div>
        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links',['description'=>$post->title])
            @include('posts.tags')
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
            @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
</article>@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="/js/twitter-bootstrap.js"></script>
@endpush

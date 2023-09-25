<div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($post->photos as $photo)

        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach ($post->photos as $photo)
            <div class="item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ Storage::url($photo->url) }}" alt="">
            </div>
        @endforeach
    </div>
</div>

<?php /** @var $post \App\Models\Post */?>
@foreach($list as $post)
<div class="col-lg-12">
    <div class="blog-post">
        <div class="blog-thumb">
            <img src="{{ $post->getImage() }}" alt="">
        </div>
        <div class="down-content">
            <a href="{{ route('post.detail', $post->id) }}"><h4>{{ $post->title }}</h4></a>
            <ul class="post-info">
                <li><a href="#">{{ $post->author->name }}</a></li>
                <li><a href="#">{{ $post->datePublished() }}</a></li>
            </ul>
            <p>{{ $post->description }}</p>
        </div>
    </div>
</div>
@endforeach

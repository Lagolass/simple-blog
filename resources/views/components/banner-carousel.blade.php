<?php /** @var $post \App\Models\Post */?>
<!-- Banner Starts Here -->
<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
        @foreach($list as $post)
            <div class="item">
                <img src="{{ $post->getImage() }}" alt="">
                <div class="item-content">
                    <div class="main-content">
                        <a href="{{ route('post.detail', $post->id) }}"><h4>{{ $post->title }}</h4></a>
                        <ul class="post-info">
                            <li><a href="#">{{ $post->author->name }}</a></li>
                            <li><a href="#">{{ $post->datePublished() }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

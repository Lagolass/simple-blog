<?php /** @var $post \App\Models\Post  */ ?>
@extends('layouts.app')
@section('banner_text')
    <h2>{{ trans('post.detail') }}</h2>
@endsection
@section('content')
    @include('components.banner')
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $post->getImage() }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <a href=""><h4>{{ $post->title }}</h4></a>
                                        <ul class="post-info">
                                            <li><a href="#">{{ $post->author->name }}</a></li>
                                            <li><a href="#">{{ $post->datePublished() }}</a></li>
                                        </ul>
                                        {!! $post->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush

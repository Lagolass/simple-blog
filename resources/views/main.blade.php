@extends('layouts.app')
@section('content')
    @if($postList->count())
        @include('components.banner-carousel', ['list' => $postList])
    @else
        @include('components.banner')
    @endif
    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @include('components.post-list', ['list' => $postList])
                            @if($postList->count())
                            <div class="col-lg-12">
                                <div class="main-button">
                                    <a href="{{ route('posts') }}">{{ trans('post.view_all') }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush

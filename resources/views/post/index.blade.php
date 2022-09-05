@extends('layouts.app')
@section('banner_text')
    <h2>{{ trans('post.recent_posts') }}</h2>
@endsection
@section('banner_text2')
    <h4>{{ trans('post.all_posts') }}</h4>
@endsection
@section('content')
    @include('components.banner')
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        @include('components.post-list', ['list' => $postList->items()])
                        {{ $postList->appends(request()->query())->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush

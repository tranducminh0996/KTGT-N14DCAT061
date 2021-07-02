@extends('layout.app')
@section('title', __('tintuc'))
@section('content')
    <div class="wrap-page">
        <div class="content-page">
            <div class="title">
                <h3 class="title-news">
                    {{$post->name}}
                </h3>
            </div>
            <div class="describe-place">
                {{$post->description}}
            </div>
            <div class="content-place">
                {!!$post->content!!}
            </div>

            <div class="author pull-right">
                @if ($post->post_source != null)
                    <span><b> Theo: {{$post->post_source}}</b></span>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/detail_news.css')}}">
@endpush
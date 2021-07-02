@extends('layout.app')
@section('title', __('video'))
@section('content')
    <div class="wrap-page">
        <div class="content-page">
            <div class="title">
                <h3 class="title-news">
                    {{$video->name}}
                </h3>
            </div>
            <div class="describe-place">
                {{$video->description}}
            </div>
            <div class="content-place">
                <iframe class="iframe-video" src="{{'https://www.youtube.com/embed/' . $video->video_url}}" allowfullscreen>
                </iframe>
            </div>

            <div class="author pull-right">
                @if ($video->post_source != null)
                    <span><b>Theo: {{$video->post_source}}</b></span>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/detail_video.css')}}">
@endpush
@extends('layout.app')
@section('title', __('tintuc'))
@section('content')
    <div class="wrap-page">
        <div class="content-page">
            {{$content}}
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/news.css')}}">
@endpush
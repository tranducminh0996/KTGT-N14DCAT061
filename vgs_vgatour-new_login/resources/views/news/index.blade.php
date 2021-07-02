@extends('layout.app')
@section('title', __('tintuc'))
@section('content')
    <div class="wrap-page">
        <div class="content-page">
            <div class="section">

                <div class="tournament-news">

                    <div class="item-news">

                        @if(isset($listPost))

                            @foreach($listPost as $keyPost => $post)
                                
                                <a class="link-post-image" href="{{'/post/' . $post->slug . '?tour=' . $tourId }}">
                                    <div class="item-content-news">
                                        <div class="thumbnail-news">
                                            <img class="image-thumbnail" src="{{$post->thumbnail}}" alt="">
                                        </div>
                                        <div class="info-text-new">
                                            <p class="title-news">
                                                {{$post->name}}
                                            </p>
                                            <p class="time-detail">
                                                <i>{{getTimePost($post->date_post)}}</i></p>
                                            <p class="describe-news">
                                                {{$post->description}}
                                            </p>
                                        </div>
                                    </div>

                                </a>

                            @endforeach

                        @endif


                    </div>


                    <div class="text-center">
                        {{$listPost->appends($_GET)->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/news.css')}}">
@endpush

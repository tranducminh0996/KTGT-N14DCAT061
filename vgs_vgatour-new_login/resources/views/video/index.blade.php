@extends('layout.app')
@section('title', __('video'))
@section('content')
    <div class="wrap-page">
        <div class="content-page">
            <div class="section">

                <div class="tournament-news">

                    <div class="item-news">

                        @if(isset($listVideo))

                            @foreach($listVideo as $keyVideo => $video)
                                <a class="link-post-image" href="{{'/video/' . $video->slug . '?tour=' . $tourId }}">
                                    <div class="item-content-news">
                                        <div class="thumbnail-news">
                                            <img class="image-thumbnail" src="{{$video->video_thumbnail_url}}" alt="">
                                        </div>
                                        <div class="info-text-new">
                                            <p class="title-news">
                                                {{$video->name}}
                                            </p>
                                            <p class="time-detail">
                                                <i>{{getTimePost($video->date_post)}}</i></p>
                                            <p class="describe-news">
                                                {{$video->description}}
                                            </p>
                                        </div>
                                    </div>

                                </a>

                            @endforeach

                        @endif


                    </div>


                    <div class="text-center">
                        {{$listVideo->appends($_GET)->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/news.css')}}">
@endpush
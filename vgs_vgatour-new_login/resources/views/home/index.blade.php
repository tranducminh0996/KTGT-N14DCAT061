@extends('layout.app')
@section('title', __('trangchu'))
@section('content')
    <div class="wrap-page">

        <div class="hero-place">
            @if(isset($listBanner))
                @foreach($listBanner as $banner)
                    @if ($banner->type == 1)
                        <a target="_blank" href="{{$banner->url}}">
                            <img class="item-banner" src="{{$banner->link_image}}" alt="">
                        </a>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="content-page">
            <div class=" section section-1">
                <div class="leader-board" id="leaderboard-livescore-home">
                    {{--                    <h5><strong>{{$tour->name}}</strong></h5>--}}

                    {{--                    <div class="icon-live blink_me"></div>--}}

                    @if($tour->link_livescore != null)
                        {{--                        <div class="iframe-place"></div>--}}
                        <iframe frameborder="0" height="426px" scrolling="no" id="iframe-livescore-home"
                                style="pointer-events: none"
                                src="{{$tour->link_livescore}}" width="100%"></iframe>
                    @else
                        <h3>Coming soon</h3>
                    @endif

                    <a href="{{'/livescore?tour_id=' . $tour->id}}" class="btn btn-show-all">{{__('xemtatca')}}</a>
                </div>

                <div class="live">

                    <h4 class="header-live">{{__('truyenhinh')}}</h4>
                   

                </div>

            </div>

            <div class="section section-2">

                <div class="tournament-news">

                    <div class="title-news">{{__('tingiaidau')}}</div>

                    <div class="row wrap-new">
                        @if(isset($listPost))
                            @foreach($listPost as $post)
                                <div class="col-md-3 col-xs-2">

                                    <div class="item-news">
                                        <div class="thumbnail-post">
                                        <a class="link-post-image" href="{{'/post/' . $post->slug . '?tour=' . $tourId }}">
                                            <img src="{{$post->thumbnail}}" alt="">
                                        </a>
                                        </div>
                                            <a class="link-post-image" href="{{'/post/' . $post->slug . '?tour=' . $tourId }}" >
                                                <p class="title-post">{{$post->name}}</p>
                                            </a>
                                        
                                        <p class="time-post">{{getTimePost($post->date_post)}}</p>
                                        <p class="des-content">{{$post->description}}
                                        </p>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>

                    <a href="{{'/news?tour_id=' . $tour->id}}" class="btn btn-show-all">{{__('xemtatca')}}</a>
                    {{--                    <button class="btn btn-show-all">{{__('xemtatca')}}</button>--}}

                </div>

            </div>

            <div class="section section-3">

                <table class=" table table-responsive tbl-ntt tbl-pc table-bordered">
                    <tr>
                        @if(isset($listBanner))
                            @foreach($listBanner as $banner)
                                @if ($banner->type == 7)
                                    <td>
                                        <div class="item-ntt">
                                            <a target="_blank" href="{{$banner->url}}">
                                                <img class="logo-ntt"
                                                     src="{{$banner->link_image}}" alt="item-ntt">
                                            </a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        @endif
                    </tr>
                </table>

                {{--                <table class="tbl-ntt tbl-mb table-bordered">--}}
                {{--                    <tr>--}}
                {{--                        @if(isset($listBanner))--}}
                {{--                            @foreach($listBanner as $banner)--}}
                {{--                                @if ($banner->type == 7)--}}
                {{--                                    <td>--}}
                {{--                                        <div class="item-ntt">--}}
                {{--                                            <img class="logo-ntt"--}}
                {{--                                                 src="{{$banner->link_image}}" alt="item-ntt">--}}
                {{--                                        </div>--}}
                {{--                                    </td>--}}
                {{--                                @endif--}}
                {{--                            @endforeach--}}
                {{--                        @endif--}}
                {{--                    </tr>--}}
                {{--                </table>--}}

            </div>

            <div class="section section-4">

                <div class="tournament-video">

                    <div class="title-video">VIDEO</div>

                    <div class="row wrap-video">
                        @if(count($listVideo) > 0)

                            @foreach($listVideo as $video)
                                <div class="col-md-4 col-xs-2">

                                    <div class="item-video">
                                        <div class="thumbnail-post">
                                        <a class="link-post-image" href="{{'/video/' . $video->slug . '?tour=' . $tourId }}">
                                            <img src="{{$video->video_thumbnail_url}}" alt="">
                                        </a>
                                        </div>
                                            <a class="link-post-image" href="{{'/video/' . $video->slug . '?tour=' . $tourId }}">
                                                <p class="title-post">{{$video->name}}</p>
                                            </a>
                                        <p class="time-post">{{getTimePost($video->publish_date)}}</p>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>

                    <a href="{{'/video?tour_id=' . $tour->id}}" class="btn btn-show-all">{{__('xemtatca')}}</a>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endpush

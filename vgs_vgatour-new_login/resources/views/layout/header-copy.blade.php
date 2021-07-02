<?php
$systemTour1 = getSystemTour();
// dd($systemTour1);
// if(isset($systemTour1)){ echo '<pre>';
// print_r($systemTour1);
// echo '</pre>';
// echo "dsdffdgdf"; } ?>
<nav class="navbar navbar-expand-md fixed-top nav-light my-navbar">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="{{route('home', ['tour' => $tourId])}}"><img class="my-logo" src="{{asset('/images/logo.svg')}}" alt=""></a>
    <?php $systemTour = getSystemTour();
    $bannerTour = '';
    foreach ($listBanner as  $banner) {
        if ($banner->tour_id == $tourId && $banner->type == 8) $bannerTour = $banner->link_image;
    }

    ?>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <div class="dropdown-mega">
                <button class="dropbtn">
                    {{__('hethonggiaidau')}}
                </button>
                <div class="dropdown-content">
                    <div class="header">
                    </div>
                    <div class="wrap-mega">
                        <div class="row content-mega">
                            <ul class="nav nav-pills tab-sub-menu" role="tablist">

                                @if (isset($systemTour))
                                @foreach($systemTour as $key => $itemSystem)
                                <li class="nav-item">
                                    <a class="nav-link {{($key==0)?'active':''}}" data-toggle="pill" href="{{'#'.$itemSystem->link}}">{{strtoupper($itemSystem->name)}} aa</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>

                            <div class="tab-content tab-content-sub-menu">
                                @if (isset($systemTour))

                                @foreach($systemTour as $key => $itemSystem)
                                <div id="{{$itemSystem->link}}" class=" tab-pane {{($key==0)?'active':''}}"><br>

                                    @if (isset($itemSystem->listTour) && count($itemSystem->listTour) > 0)
                                    <div class=" d-none d-sm-block">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list_tour">
                                                    @foreach($itemSystem->listTour as $tour)
                                                    <li><a href="{{route('home', ['tour_id' => $itemSystem->listTour[0]->id])}}" style="color:#ffffff;" class="btn btn-go-to-event">
                                                            {{$tour->name}} bb</a><i class="minh-minhtd"></i>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="img-tour-menu">
                                                    <img src="{{$bannerTour}}" alt="">
                                                </div>
                                                <div class="content-tour-menu">
                                                    <p class="text-center">{{$itemSystem->listTour[0]->name}}</p>
                                                    <div class="info-tour-select">
                                                        <p>
                                                            {{__('santhidau')}}
                                                            : {{$itemSystem->listTour[0]->facility_id}}
                                                        </p>
                                                        <p>
                                                            {{__('ngaythidau')}}: 01-05/12/2020.
                                                        </p>
                                                        <p>
                                                            {{__('soluongvandongvien')}}
                                                            : {{$itemSystem->listTour[0]->number_athletic}}
                                                        </p>
                                                        <p>{{$itemSystem->listTour[0]->describe}}</p>
                                                    </div>

                                                    <a href="{{route('home', ['tour_id' => $itemSystem->listTour[0]->id])}}" class="btn btn-go-to-event">
                                                        {{__('didentrangsukien')}}</a>

                                                </div>
                                            </div>
                                            <div class="col-md-4 ntt-rolex">
                                                <div class="item-ntt-rolex">
                                                    <img src="{{asset('images/rolex.svg')}}" alt="">
                                                </div>
                                                <div class="item-ntt-rolex">
                                                    <img src="{{asset('images/rolex.svg')}}" alt="">
                                                </div>
                                                <div class="item-ntt-rolex">
                                                    <img src="{{asset('images/rolex.svg')}}" alt="">
                                                </div>
                                                <div class="item-ntt-rolex">
                                                    <img src="{{asset('images/rolex.svg')}}" alt="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <div class="row .d-block .d-sm-none">
                                                    <div class="col-12">

                                                        @foreach($itemSystem->listTour as $tour)
                                                            <a href="{{route('home', ['tour_id' => $itemSystem->listTour[0]->id])}}"
                                                               style="color:#ffffff;"
                                                               class="btn btn-go-to-event">
                                                                {{$tour->name}}</a>
                                                        @endforeach
                                                    </div>
                                                </div> -->

                                    @else
                                    <h3 class="text-center">Comming soon</h3>
                                    @endif
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/schedule?tour={{$tourId}}">
                    {{__('lichthidau')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/athletic?tour={{$tourId}}">
                    {{__('vandongvien')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/news?tour={{$tourId}}">
                    {{__('tintuc')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/video?tour={{$tourId}}">
                    {{__('video')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/image-library?tour={{$tourId}}">
                    {{__('thuvienanh')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/leaderboard?tour={{$tourId}}">
                    {{__('bangxephang')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/livescore?tour={{$tourId}}">Livescore</a>
            </li>
        </ul>
    </div>
</nav>
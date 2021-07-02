@extends('layout.app')
@section('title', 'Hồ sơ vận động viên')
@section('content')
    <div class="wrap-page">

        <div class="content-page">
            <div class="section">

                <input type="text" class="search_athletic" placeholder="{{__('nhapdetimkiem')}}"
                       value="{{(isset($nameSelect)?$nameSelect:null)}}">

                <ul class="tab-athletic">
                    <li>
                        <a href="{{route('awardAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('thanhtich')}}</a>
                    </li>
                    <li>
                        <a href="{{route('scoreTourAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('diemso')}}</a>
                    </li>
                    <li class="active">
                        <a href="{{route('infoAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('hoso')}}</a>
                    </li>
                </ul>

                <div class="clearfix"></div>

                <div class="table-award-athletic-place">

                    <div class="info-athletic-place">

                        <div class="info-detail-athletic">
                            <img src="{{$athletic->avatar}}" alt="avatar-athletic" class="avatar-athletic">

                            <div class="info-athletic-view">
                                <div>
                                    <p class="name-athletic">{{$athletic->first_name . ' ' . $athletic->last_name}}</p>
                                    <p class="country-athletic">{{$athletic->country_name}}</p>
                                </div>

                                <div class="list-deatail-athletic">
                                    <ul class="list-info-athletic">
                                        <li class="item-info-athletic"><p>{{__('ngaysinh')}}:
                                                <b>{{\Carbon\Carbon::parse($athletic->birthday)->format('d-m-Y')}}</b>
                                            </p>
                                        </li>
                                        <li class="item-info-athletic"><p>{{__('quoctich')}}: <b>{{$athletic->country_name}}</b></p></li>
                                        <li class="item-info-athletic"><p>{{__('thamgiavgatour')}}: <b>{{\Carbon\Carbon::parse($athletic->date_vgatour)->format('d-m-Y')}}</b>
                                            </p>
                                        </li>
                                        <li class="item-info-athletic"><p>{{__('turnpro')}}: <b>{{\Carbon\Carbon::parse($athletic->turn_pro)->format('d-m-Y')}}</b></p></li>
                                        <li class="item-info-athletic"><p>{{__('chieucao')}}, {{__('cannang')}}:
                                                <b>{{$athletic->height . 'cm'}},
                                                    {{$athletic->weight}}kg</b></p>
                                        </li>
                                        <li class="item-info-athletic"><p>{{__('tongtienthuong')}}: <b>{{number_format($athletic->total_money, 0, ',', '.')}}
                                                    VND</b>
                                            </p>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        @if (count($listTimeline) > 0)
                            <div class="list-timeline-athletic">
                                <ul>
                                    @foreach($listTimeline as $timeline)
                                        <li>
                                            <p>
                                                <b><span
                                                        class="time-info">{{$timeline->title}}:</span></b> {{$timeline->content}}
                                            </p></li>
                                    @endforeach
                                </ul>

                            </div>
                        @else
                            <h3 class="text-center">{{__('vandongvienchuacohoatdong')}}</h3>
                        @endif
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/athletic.css')}}">
@endpush

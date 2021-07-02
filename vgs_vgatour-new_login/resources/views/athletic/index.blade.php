@extends('layout.app')
@section('title', 'Vận động viên')
@section('content')
    <div class="wrap-page">

        <div class="content-page">
            <div class="section">

                {!! Form::open(['route' => 'athletic.index', 'method' => 'get', 'class' => 'input_search_athletic']) !!}

                <input type="text" class="search_athletic" placeholder="{{__('nhapdetimkiem')}}" name="search_athletic"
                       value="{{(isset($keyword)?$keyword:null)}}">
                {!! Form::close() !!}

                <div class="clearfix"></div>

                <div class="list-athletic">
                    <div class="row row-athletic">
                        @foreach($listAthletic as $valueAthletic)
                            <div class="col-sm-6 col-6 col-md-2">

                                <div class="item-athletic">
                                    <a href="{{route('awardAthletic', [$valueAthletic->id, 'codeAthletic' => $valueAthletic->code_athletic, 'nameSelect' => $valueAthletic->first_name . ' ' . $valueAthletic->last_name])}}">
                                        <div class="avatar-place">
                                            <img class="avatar-golfer" src="{{$valueAthletic->avatar}}"
                                                 alt="{{$valueAthletic->first_name}}">
                                        </div>
                                        <div class="info-athletic">
                                            <p class="name-athletic">
                                                <b>{{$valueAthletic->first_name . ' ' . $valueAthletic->last_name}}</b>
                                            </p>
                                            <div class="country-place">
                                                <p class="country">{{$valueAthletic->country_name}}</p>
                                                <img class="flag-athletic"
                                                     src="https://scorelive.vhandicap.com/image/flag/GER.png" alt="">
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center">
                    {{$listAthletic->appends($_GET)->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/athletic.css')}}">
@endpush
@push('script_bot')
    <script src="/js/athleticIndex.js"></script>
@endpush

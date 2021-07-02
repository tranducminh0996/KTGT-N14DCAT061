@extends('layout.app')
@section('title', __('lichthidau'))
@section('content')
    <div class="wrap-page">

        <div class="content-page">
            <div class="section">

                <div class="tournament-schedule">

                    <div class="item-schedule">
                        <div class="title-schedule">
                            <span class="facility_schedule-tournament"><b>{{$tour->name}}</b></span><span
                                class="time-tournament"><b></b></span></div>

                        @if(isset($listDate))

                            @foreach($listDate as $keyDate => $date)

                                {!! Form::hidden('tournament_id', $tour->id, ['class' => 'tournament']) !!}

                                <div class="item-content-schedule">
                                    <div class="time-detail">
                                        <b>{{\Carbon\Carbon::parse($date->date)->format('l, d M Y')}}</b></div>
                                    <span class="seperate-schedule"></span>
                                    <div class="address-schedule">
                                        <p><b>{{$tour->name}} day {{$keyDate + 1}}</b></p>
                                        <p>{{$tour->sub_title}}, {{$tour->address}}</p>
                                    </div>
                                    {{--                                <span class="seperate-schedule"></span>--}}

                                    {{--                                <div class="cost-schedule">--}}
                                    {{--                                    <p><b>500k VND - Ticket</b></p>--}}
                                    {{--                                    <a href="#">{{__('muangay')}}</a>--}}
                                    {{--                                </div>--}}
                                </div>

                            @endforeach

                        @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/schedule.css')}}">
@endpush

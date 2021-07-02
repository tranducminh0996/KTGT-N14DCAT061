@extends('layout.app')
@section('title', __('bangxephang'))
@section('content')
    <div class="wrap-page">

        <div class="content-page">
            <div class="section">

                <div class="tournament-leaderboard table-responsive-sm">
                    <table class="table table-hover table-striped  table-bordered table-leaderboard-athletic">
                        <thead>
                        <tr>
                            <th>{{__('rank')}}</th>
                            <th class="text-center">{{__('quoctich')}}</th>
                            <th>{{__('hovaten')}}</th>
                            <th class="text-center">{{__('sokytop1')}}</th>
                            <th class="text-center">{{__('sotran')}}</th>
                            <th class="text-right">{{__('trungbinhdiem')}}</th>
                            <th class="text-right">{{__('tongcongdiem')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($listAthletic as $key => $athletic)

                            <tr>
                                <td >{{$key + 1}}</td>
                                <td class="text-center"><img src="{{$athletic->image_country}}" class="image_country"></td>
                                <td class="text-left">{{$athletic->last_name . ' ' . $athletic->first_name}}</td>
                                <td class="text-center">{{$athletic->weight}}</td>
                                <td class="text-center">{{$athletic->weight}}</td>
                                <td class="text-right">{{number_format($athletic->total_money/$athletic->weight, 1, ',', '.')}}</td>
                                <td class="text-right">{{number_format($athletic->total_money, 1, ',', '.')}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="text-center">
                    {{$listAthletic->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/leaderBoardMoney.css')}}">
@endpush

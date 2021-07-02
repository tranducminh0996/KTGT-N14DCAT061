@extends('layout.app')
@section('title', 'Thành tích vận động viên')
@section('content')
    <div class="wrap-page">

        <div class="content-page">
            <div class="section">

                <input type="text" class="search_athletic" placeholder="{{__('nhapdetimkiem')}}"
                       value="{{(isset($nameSelect)?$nameSelect:null)}}">

                <ul class="tab-athletic">
                    <li class="active">
                        <a href="{{route('awardAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('thanhtich')}}</a></li>
                    <li>
                        <a href="{{route('scoreTourAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('diemso')}}</a></li>
                    <li>
                        <a href="{{route('infoAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('hoso')}}</a></li>
                </ul>

                <div class="clearfix"></div>
                <div class="table-award-athletic-place">

                    @if (count($listAward) > 0)
                        <table class="table table-striped table-award-athletic-place">
                            <tr>
                                <th>{{__('giaidau')}}</th>
                                <th class="text-center">{{__('chienthang')}}</th>
                                <th class="text-center">{{__('Top :rank', ['rank' => '10'])}}</th>
                                <th class="text-center">{{__('Top :rank', ['rank' => '20'])}}</th>
                                <th class="text-center">{{__('quacut')}}</th>
                                <th class="text-right">{{__('tienthuong')}}</th>
                            </tr>
                            @foreach($listAward as $valueAward)
                                <tr>
                                    <td>{{$valueAward->name}}</td>
                                    <td class="text-center">
                                        @if ($valueAward->award == 1)
                                            <img src="/images/icon_winner.svg" style="display: inline-block">
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if ($valueAward->award == 10)
                                            @if ($valueAward->is_tie_position == 1)
                                                {{'T' . $valueAward->ranking}}
                                            @else
                                                {{$valueAward->ranking}}
                                            @endif
                                        @else
                                            @if ($valueAward->ranking <= 10)
                                                <img src="/images/icon_pass_cut.svg" style="display: inline-block">
                                            @else
                                                -
                                            @endif
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if ($valueAward->award == 20)
                                            @if ($valueAward->is_tie_position == 1)
                                                {{'T' . $valueAward->ranking}}
                                            @else
                                                {{$valueAward->ranking}}
                                            @endif
                                        @else
                                            @if ($valueAward->ranking <= 20)
                                                <img src="/images/icon_pass_cut.svg" style="display: inline-block">
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($valueAward->award != 0)
                                            <img src="/images/icon_pass_cut.svg" style="display: inline-block">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        {{number_format($valueAward->money_price, 0, ',', '.') . ' VND'}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h3 class="text-center">{{__('vandongvienchuacohoatdong')}}</h3>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/athletic.css')}}">
@endpush

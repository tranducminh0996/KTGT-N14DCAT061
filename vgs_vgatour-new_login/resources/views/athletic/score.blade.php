@extends('layout.app')
@section('title', 'Thành tích vận động viên')
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
                    <li class="active">
                        <a href="{{route('scoreTourAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('diemso')}}</a>
                    </li>
                    <li>
                        <a href="{{route('infoAthletic', [$id, 'codeAthletic' => $codeAthletic, 'nameSelect' => $nameSelect])}}">{{__('hoso')}}</a>
                    </li>
                </ul>

                <div class="clearfix"></div>

                <ul class="item-score-award">
                    <li>
                        <div>
                            <img src="{{'/images/icon_tournament/eagle.svg'}}" class="icon-score-award">
                            <span>EAGLES+</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="{{'/images/icon_tournament/birdie.svg'}}" class="icon-score-award">
                            <span>BIRDIES</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="{{'/images/icon_tournament/bogey.svg'}}" class="icon-score-award">
                            <span>BOGEYS</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="{{'/images/icon_tournament/double_bogey.svg'}}" class="icon-score-award"> <span>DOUBLE BOGEYS +</span>
                        </div>
                    </li>
                </ul>

                <div class="clearfix"></div>

                <div class="table-award-athletic-place">

                    @if (count($listTourAthletic) > 0)

                        @foreach($listTourAthletic as $key => $tour)

                            <div class="tournament-score-view">
                                <div class="item-score-view">
                                    <div class="title-score-view">
                                        <span class="facility_score-view-tournament"><b>{{$tour->name}}</b></span><span
                                            class="time-tournament"><b>1.000.000 VND -  4 days</b></span></div>

                                    <table class="table table-score-athletic">
                                        <tr>
                                            <td>Hole</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                        </tr>
                                        @if(isset($tour->athleticScore) && count($tour->athleticScore) > 0)
                                            <tr>
                                                <td>Par</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[0]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[1]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[2]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[3]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[4]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[5]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[6]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[7]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[8]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[9]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[10]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[11]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[12]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[13]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[14]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[15]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[16]->par}}</td>
                                                <td>{{$tour->athleticScore[0]->scoreHole[17]->par}}</td>
                                            </tr>
                                            @foreach($tour->athleticScore as $index => $scoreDate)

                                                <tr>
                                                    <td>R{{$index}}</td>
                                                    @foreach($scoreDate->scoreHole as $score)
                                                        <td>{{($score->gross > 0)?$score->gross:'-'}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>

                                </div>
                            </div>

                        @endforeach

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

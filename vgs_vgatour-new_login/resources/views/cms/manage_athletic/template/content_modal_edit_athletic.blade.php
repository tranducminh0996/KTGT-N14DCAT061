<div class="info-detail-athletic">
    <img src="{{$athletic->avatar}}" alt="avatar-athletic" class="avatar-athletic">

    <div class="info-athletic">
        <div>
            <p class="name-athletic">{{$athletic->first_name . ' ' . $athletic->last_name}}</p>
            <p class="country-athletic">{{$athletic->country}}</p>
        </div>

        <div class="list-deatail-athletic">
            <ul class="list-info-athletic">
                <li class="item-info-athletic"><p>Ngày sinh: <b>{{$athletic->birthday}}</b></p></li>
                <li class="item-info-athletic"><p>Quốc tịch: <b>{{$athletic->country}}</b></p></li>
                <li class="item-info-athletic"><p>Tham gia Vgatour: <b>{{$athletic->date_vgatour}}</b></p></li>
                <li class="item-info-athletic"><p>Turn Pro: <b>{{$athletic->turn_pro}}</b></p></li>
                <li class="item-info-athletic"><p>Chiều cao, cân nặng: <b>{{$athletic->height}}cm, {{$athletic->weight}}
                            kg</b></p>
                </li>
                <li class="item-info-athletic"><p>Tổng tiền thưởng:
                        <b>{{number_format($athletic->total_money, 0, ',', '.')}} VND</b>
                    </p>
                </li>
            </ul>
        </div>

    </div>
</div>

<div class="list-timeline-athletic">
    @if(count($listTimeline) == 0)
        <h4 class="text-center">Vận động viên chưa có hoạt động nào được ghi nhận</h4>
    @else
        <ul>
            @foreach($listTimeline as $timeline)
                <li><p><span style="color: red">({{$timeline->stt_view}})</span><b><span class="time-info">{{$timeline->title}}:</span></b> {{$timeline->content}}
                    </p></li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route' => ['manage_athletic.storeTimeline'], 'method' => 'post']) !!}

    <div class="form-timeline"></div>


    <button type="button" class="btn btn-secondary btn-add-timeline"> + {{__('themsukien')}}</button>

    <br><br>

    <div class="text-center">
        <button type="submit" class="btn btn-primary submit-edit-athletic">{{__('luu')}}</button>
    </div>
    {!! Form::hidden('athletic_id', $athletic->id, []) !!}

    {!! Form::close() !!}
</div>

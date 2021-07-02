<div>
    @if (isset($listYearSelect) && count($listYearSelect) > 0)
        @foreach($listYearSelect as $year)
            <button class="btn btn-primary" id-year="{{$year->id}}">{{$year->value}}</button>
        @endforeach
    @endif

    <button class="btn btn-primary btn-add-banner btn-add-year"> + Thêm</button>
</div>



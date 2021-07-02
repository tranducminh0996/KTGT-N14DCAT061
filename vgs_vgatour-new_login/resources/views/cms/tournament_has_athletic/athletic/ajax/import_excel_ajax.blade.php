<table class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" style="width: 5%">Top</th>
        <th class="text-center" style="width: 5%">ID</th>
        <th class="text-center" style="width: 25%">{{__('ten')}}</th>
        <th class="text-center" style="width: 25%">{{__('tienthuong')}}</th>
        <th class="text-center" style="width: 20%">{{__('thutu')}}</th>
        <th class="text-center" style="width: 10%">CUT</th>
        <th class="text-center" style="width: 10%">{{__('thaotac')}}</th>

    </tr>
    </thead>
    <tbody>
    @if(empty($tournamentWithAthletic['athletics']->toArray()) === false)
        @foreach($tournamentWithAthletic['athletics'] as $key => $item)
            <tr>
                <th class="text-center" scope="row">{{$key + 1}}</th>
                <td class="text-center">{{$item->code_athletic}}</td>
                <td class="text-center">{{$item->first_name . ' ' . $item->last_name}}</td>
                <td class="text-center">{{number_format($item->total_bonus)}}</td>
                <td class="text-center">{{$item->ranking}}</td>
                <td class="text-center">
                    @if($item->is_cut == 1)
                        OK
                    @else
                        NOT
                    @endif</td>
                <td class="text-center">
                    <a data-toggle="modal" data-athleticID="{{$item['pivot']['athletic_id']}}" data-target="#modalConfirmDelete" data-tournamentId="{{$tournament->id}}"
                       href="{{route('tournament.ranking.delete', $item->id . '/' . $tournament->id)}}">
                        Xóa
                    </a>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <th colspan="7" class="text-center">{{__('giaidauchuacodulieu')}}</th>
        </tr>
    @endif
    </tbody>
</table>

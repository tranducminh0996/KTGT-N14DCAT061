<div class="funtion-athletic">

    <div class="form-group">
        <a class="btn btn-primary" href="{{route('manage_athletic.index')}}">{{__('danhsachhoivien')}}
        </a>
        <a class="btn btn-primary" href="{{route('manage_athletic.approve')}}">{{__('duyethoivienmoi :index', ['index' => 1])}}
        </a>
        <a class="btn btn-primary" href="{{route('manage_athletic.remove')}}">{{__('khaitruhoivien')}}
        </a>
        <a class="btn btn-primary" href="{{route('manage_athletic.advertise')}}">{{__('quangcaotrangVDV')}}
        </a>


        <input type="text" name="search_athletic" class="form-control search_athletic" placeholder="{{__('nhapdetimkiem')}}">


        <!-- <form method="GET" action="/cms/manage_athletic" accept-charset="UTF-8" class="input_search_athletic">
            <input type="text" name="search_athletic" class="form-control search_athletic" placeholder="{{__('nhapdetimkiem')}}">
        </form> -->
    </div>

</div>
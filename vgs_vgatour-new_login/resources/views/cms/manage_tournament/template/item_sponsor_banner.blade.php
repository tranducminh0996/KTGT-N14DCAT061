<div class="item-upload">

    <div class="widget-upload">
        <div class="icon-upload"></div>
        <div class="header-upload">
            <span class="title-upload">{{$title_upload}}</span>
        </div>
        <div class="body-upload {{$pos}}">

            @if (isset($listBanner))

            @foreach($listBanner as $banner)

            @if($banner->type == $type)

            <div class="content-upload">
                <div style="max-height: 40px; max-width: 100px; min-width: 100px; text-align:center;">
                    <img src="{{$banner->link_image}}" alt="" class="view-upload-image" style="width: auto; height: 100%">
                </div>

                <input type="file" class="banner-select" disabled>


                <div class="view-upload">
                    <input type="text" class="link-{{$pos}} form-control" required value="{{$banner->url}}" placeholder="Nhập link" disabled>
                </div>
                <div class="view-upload">
                    <label class="switch">
                        <input type="checkbox" banner-id="{{$banner->id}}" {{$banner->status == 1?'checked':''}} class="slider-status">
                        <span class="slider round"></span>
                    </label>
                </div>

                <div class="name-image view-upload">
                    <p class="upload-by">{{__('nguoithem')}}: {{$banner->name}}
                        - {{$banner->created_at}}</p>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
    </div>
    
    <button type="button" class="btn btn-info btn-add-banner" type-banner="{{$type}}" pos="{{$pos}}">
        + {{__('them')}}</button>

</div>
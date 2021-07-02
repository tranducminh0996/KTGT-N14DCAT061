<div class="item-upload">

    <div class="widget-upload">
        <div class="icon-upload"></div>
        <div class="header-upload">
            <span class="title-upload">{{$title_upload}}</span>

        </div>
        <div class="body-upload {{$pos}}">

            @foreach($listBanner as $banner)

            @if($banner->type == $type)

            <div class="content-upload">
                <div style="max-height: 40px; max-width: 100px; min-width: 100px; text-align:center;">
                    <img src="{{$banner->link_image}}" alt="" class="view-upload-image" style="width: auto; height: 100%">
                </div>

                <div class="custom-file" style="width: 300px;">
                    <input type="file" class="custom-file-input " name="banner_{{$pos}}[]" style="width: 300px;" accept="image/*" disabled> <label class="custom-file-label" style="text-align: left;width: 300px;">Chọn File </label>
                </div>

                <div class="view-upload">
                    <input type="text" name="link_{{$pos}}[]" class="link-{{$pos}} form-control" required placeholder="Nhập link" disabled>
                </div>


                <div class="view-upload">
                    <label class="switch">
                        <input type="checkbox" banner-id="{{$banner->id}}" {{$banner->status == 1?'checked':''}} class="slider-status">
                        <span class="slider round"></span>
                    </label>
                </div>

                <div class="name-image view-upload">
                    <p class="upload-by">{{__('nguoithem')}}: {{$banner->name}} - {{$banner->created_at}}</p>
                </div>
                <div class="view-upload">

                    <a class="btn delete_user" href="javascript:void(0);" id="{{$banner->id}}"><i class="far fa-trash-alt" style="color:red;"></i></a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <button type="button" class="btn btn-info btn-add-banner" type-banner="{{$type}}" pos="{{$pos}}"> + {{__('them')}}</button>

</div>
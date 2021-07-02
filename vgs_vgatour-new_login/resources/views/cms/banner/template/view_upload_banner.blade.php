<div class="content-upload">
    <div style="max-height: 40px; max-width: 100px; min-width: 100px; text-align:center;">
        <img src="" alt="" class="view-upload-image"
             style="width: auto; height: 100%">
    </div>

    <input type="hidden" name="type_{{$pos}}[]" class="banner-select" value="{{$type}}">

    <input type="hidden" name="tag_position[]" class="banner-select" value="{{$pos}}">

    <!-- <input type="file" name="banner_{{$pos}}[]" class="banner-select" accept="image/*" style="width: 300px;"> -->
    <div class="custom-file" style="width: 300px;">
        <input type="file" class="custom-file-input " name="banner_{{$pos}}[]" style="width: 300px;" accept="image/*">  
            <label class="custom-file-label" style="text-align: left;width: 300px;">Chọn File </label>
    </div>

    <div class="view-upload" style="width: 156px;">
        <input type="text" name="link_{{$pos}}[]" class="link-{{$pos}} form-control" required
               placeholder="Nhập link">
    </div>
</div>

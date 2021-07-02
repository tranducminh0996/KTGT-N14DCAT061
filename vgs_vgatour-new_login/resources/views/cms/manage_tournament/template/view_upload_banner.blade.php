<div class="content-upload">
    <div style="max-height: 40px; max-width: 100px; min-width: 100px; text-align:center;">
        <img src="" alt="" class="view-upload-image" style="width: auto; height: 100%">
    </div>

    <input type="hidden" name="type[]" class="banner-select" value="{{$type}}">

    <input type="hidden" name="tag_position[]" class="banner-select" value="{{$pos}}">

    <input type="file" name="link_image[]" class="banner-select" accept="image/*">

    <div class="view-upload">
        <input type="text" name="url[]" class="link-{{$pos}} form-control" required placeholder="Nhập link" title="Nhập link ảnh không dấu">
        
    </div>
</div>
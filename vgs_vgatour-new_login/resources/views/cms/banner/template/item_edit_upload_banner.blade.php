<div class="item-upload">
    <div class="widget-upload">
        <div class="icon-upload"></div>
        <div class="header-upload">
            <span class="title-upload">{{$title_upload}}</span>
        </div>
        <div class="body-upload">
            <div class="content-upload">
                <img src="http://via.placeholder.com/65x30" alt="" class="view-upload">

                <div class="name-image view-upload">
                    <p class="name-image-upload">FLC Viet Nam master 1 - 2020</p>
                    <p class="upload-by">Người thêm: Châu Hương - ngày 12/12/2021</p>
                </div>

                <div class="view-upload">
                    <input type="file" name="banner-{{$pos}}">
                </div>
                <div class="view-upload">
                    <input type="text" name="link-{{$pos}}" class="link-{{$pos}} form-control" placeholder="Nhập link">
                </div>
                <div class="view-upload">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-add-banner"> + Thêm</button>
</div>

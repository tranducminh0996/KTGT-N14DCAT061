@extends('cms.layout.app')
@section('title', __('quanlytranghome'))
@section('content')

<div class="wrap-content-page">


    <div class="forrm-group" style="width: 25%">
        {!! Form::select('tourSelect', array() , null , ['class' => 'form-control tourSelect', 'style' => 'width: 300px;']) !!}
    </div>

    {!! Form::open(['url' => route('banner_home.update', [$tourId]), 'method' => 'put', 'enctype'=> "multipart/form-data", 'id' => 'upload_banner']) !!}

    <h3 class="text-center">{{$tour->name}}</h3>

    <div class="list-banner-home">
        @include('cms.banner.template.item_upload_banner', ['title_upload' => 'Quảng cáo trung tâm bên trên (1300 X 600 Pixel)', 'pos' => 'center_top', 'type' => 1, 'listBanner' => $listBanner])
        @include('cms.banner.template.item_upload_banner', ['title_upload' => 'Quảng cáo cánh trái bên trên (250 X 500 Pixel)', 'pos' => 'left_top', 'type' => 2, 'listBanner' => $listBanner])
        @include('cms.banner.template.item_upload_banner', ['title_upload' => 'Quảng cáo cánh trái bên dưới (250 X 500 Pixel)', 'pos' => 'left_bottom', 'type' => 3, 'listBanner' => $listBanner])
        @include('cms.banner.template.item_upload_banner', ['title_upload' => 'Quảng cáo cánh phải bên trên (250 X 500 Pixel)', 'pos' => 'right_top', 'type' => 4, 'listBanner' => $listBanner])
        @include('cms.banner.template.item_upload_banner', ['title_upload' => 'Quảng cáo cánh phải bên dưới (250 X 500 Pixel)', 'pos' => 'right_bottom', 'type' => 5, 'listBanner' => $listBanner])
    </div>

    <br>
    <br>

    <div class="text-center">
        {!! Form::submit('Lưu', ['class' => 'btn btn-success' ]) !!}
    </div>

    {!! Form::close() !!}

</div>
@endsection
@push('style_head')
<link rel="stylesheet" href="{{asset('css/banner_home.css')}}">
@endpush
@push('script_bot')
<script src="/plugin/select2/js/select2.min.js"></script>
<script src="/plugin/select2/js/i18n/vi.js"></script>
<script src="/js/helperImage.js"></script>
<script>
    $(document).ready(function() {
        // Add the following code if you want the name of the file appear on select


        var searchTour = '{{route("searchTour")}}';
        let data = [{
                id: 0,
                text: 'enhancement'
            },
            {
                id: 1,
                text: 'bug'
            },
            {
                id: 2,
                text: 'duplicate'
            },
            {
                id: 3,
                text: 'invalid'
            },
            {
                id: 4,
                text: 'wontfix'
            }
        ];


        $('.tourSelect').select2({
            language: "vi",
            allowClear: true,
            minimumInputLength: 1,
            placeholder: 'Chọn giải',
            ajax: {
                url: searchTour,
                dataType: 'json',
                type: "GET",
                quietMillis: 500,

                data: data,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        }).on("select2:select", function(e) {
            var id = e.params.data.id;
            window.location.href = `/cms/banner_home?tour_id=${id}`;
        });
        
        let deleteHomeBanner = '{{route("deleteBannerHome")}}';
        $('.delete_user').click(function() {
            if (confirm('Are you sure?')) {
                var id = $(this).attr('id');
                let rm = $(this).parent();

                $.ajax({
                    url: deleteHomeBanner,
                    type: 'post', // replaced from put
                    dataType: "JSON",
                    data: {
                        delete_id: id
                    },
                    success: function(response) {},
                    error: function(xhr) {
                        let ab = xhr.responseText;

                        if (ab == 'okela') {
                            let rm1 = rm.parent().remove();
                        }
                    }
                });

            }
        });


        $(".deletebtn").click(function() {
            let banner_id = $(this).attr('banner-id');


        });
        $(".custom-file-input").on("change", function() {
            let fileName = $(this).val().split("\\").pop();
            console.log(fileName);

            $(this).siblings(".custom-file-label").html(fileName);

        });

    });

    var urlUpdateStatusBanner = '{{route("updateStatusBanner")}}'
    $(document).on('change', '.slider-status', function(e) {

        let banner_id = $(this).attr('banner-id');

        var ischecked = $(this).is(":checked");

        if (ischecked) {
            var status = 1;
        } else {
            var status = 0;
        }

        $.ajax({
            type: 'post',
            url: urlUpdateStatusBanner,
            data: {
                banner_id: banner_id,
                status: status
            },

            success: function(response) {

                if (response.error_code === 0) {
                    window.showMessage(response.data.message, 'success');
                } else {
                    window.showMessage(response.data.message, 'danger');
                }

            }
        })

    });

    $(document).on('click', '.btn-add-banner', function(e) {

        let pos = $(this).attr('pos');
        let type = $(this).attr('type-banner');

        addView(pos, type);

    });

    var urlAddView = '{{route("addViewUpload")}}'

    function addView(pos, type) {

        $.ajax({
            type: 'get',
            url: urlAddView,
            data: {
                pos: pos,
                type: type
            },

            success: function(response) {

                $(`.${pos}`).append(response);

            }
        })
    }

    $(document).on('change', '.custom-file-input', function(event) {
        let limit = 23;
        view = $(this).closest('.content-upload').find('.view-upload-image');

        window.previewImage(this, view);
        let fileName = String($(this).val().split("\\").pop());

        if (fileName.length > limit) {
            // now limit it and set it as fileName
            fileName = fileName.substring(0, parseInt(limit/2))+"..."+fileName.substring(fileName.length-parseInt(limit/2), fileName.length) ;
        }

        $(this).siblings(".custom-file-label").html(fileName);


    });

    $('#upload_banner').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
@endpush
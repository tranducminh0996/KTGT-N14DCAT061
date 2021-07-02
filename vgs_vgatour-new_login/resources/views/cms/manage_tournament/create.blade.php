@extends('cms.layout.app')
@section('title', __('taomoigiaidau'))
@section('content')

@if ($errors->any())
<div class="p-3 mb-2 bg-danger text-white"  >
        <ul>
            @foreach ($errors->getKeyRegex("/url.(.*)/") as $key => $error)
                @foreach ($error as  $valueError)
                    <li> Ảnh {{ $key . ' '. $valueError }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif
<div class="wrap-content-page">

    {!! Form::open(['url' => route('manage_tour.store'), 'method' => 'post', 'enctype'=> "multipart/form-data", 'id' => 'upload_banner']) !!}

    <h3 class="text-center">{{__('taomoigiaidau')}}</h3>


    <div class="item-upload">

        <div class="widget-upload">
            <div class="icon-upload"></div>
            <div class="header-upload">
                <span class="title-upload">{{__('thongtin')}}</span>
            </div>
            <div class="body-upload">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <b>{!! Form::label('name', __('nhaptengiaidau'), ['class' => 'control-label']) !!}</b>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <b>{!! Form::label('time', __('nam'), ['class' => 'control-label']) !!}</b>
                            {!! Form::number('time', null, ['class' => 'form-control']) !!}
                            @error('time')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('name', __('chonsanthidau'), ['class' => 'control-label']) !!}</b>
                            {!! Form::select('facility_id', [], null, ['class' => 'form-control select-facility']) !!}
                            @error('facility_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('number_athletic', __('chonsoluongVDV'), ['class' => 'control-label']) !!}</b>
                            {!! Form::number('number_athletic', null, ['class' => 'form-control']) !!}
                            @error('number_athletic')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('link_livescore', __('linklivescore'), ['class' => 'control-label']) !!}</b>
                            {!! Form::text('link_livescore', '', ['class' => 'form-control', 'placeholder' => 'Link livescore có thể để trống']) !!}
                            @error('link_livescore')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('name', __('hethonggiai'), ['class' => 'control-label']) !!}</b>
                            {!! Form::select('system_tour_id', $listSystemTour, "", ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="list-banner-home">

        @include('cms.manage_tournament.template.item_sponsor_banner', ['title_upload' => __('anhdaidiengiaidau'), 'pos' => 'cover', 'type' => 8, 'listBanner' => array()])
    </div>
    <div class="list-banner-home">
        @include('cms.manage_tournament.template.item_sponsor_banner', ['title_upload' => __('logontt'), 'pos' => 'sponsor', 'type' => 7, 'listBanner' => array()])
    </div>

    <div class="item-upload">

        <div class="widget-upload">
            <div class="icon-upload"></div>
            <div class="header-upload">
                <span class="title-upload">{{__('gioithieuvegiaidau')}}</span>
            </div>
            <div class="body-upload">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::textarea('describe', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        var searchFacility = '{{route("searchFacility")}}';


        $('.select-facility').select2({
            language: "vi",
            allowClear: true,
            minimumInputLength: 1,
            placeholder: 'Chọn sân',
            ajax: {
                url: searchFacility,
                dataType: 'json',
                type: "GET",
                quietMillis: 500,
                data: function(key) {
                    return {
                        keyword: key
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.sub_title,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $(document).on('click', '.btn-add-banner', function(e) {

            let pos = $(this).attr('pos');
            let type = $(this).attr('type-banner');

            addView(pos, type);

        });

        var urlAddView = '{{route("manage_tour.addViewUpload")}}'

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

        $(document).on('change', '.banner-select', function(event) {

            view = $(this).closest('.content-upload').find('.view-upload-image');

            window.previewImage(this, view);
        });

        $('#upload_banner').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    });
</script>
@endpush
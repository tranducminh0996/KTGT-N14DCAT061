@extends('cms.layout.app')
@section('title', __('quanlygiaidau'))
@section('content')
<div class="wrap-content-page">

    <div class="forrm-group" style="width: 25%">
        {!! Form::select('tourSelect', array() , null , ['class' => 'form-control tourSelect', 'style' => 'width: 300px;']) !!}
    </div>

    {!! Form::open(['url' => route('manage_tour.update', [$tourId]), 'method' => 'put', 'enctype'=> "multipart/form-data", 'id' => 'upload_banner']) !!}

    <h3 class="text-center">{{$tour->name}}</h3>

    <br>
    <br>

    <div class="form-group">
        <a href="{{route('manage_tour.create')}}" class="my-btn my-btn-primary" target="_blank"><i class="fa fa-plus"></i> {{__('taogiaidaumoi')}}</a>
    </div>
    <!-- <button type="button" class="my-btn my-btn-primary " data-toggle="modal" data-target="#addtour"> Tạo giải đấu mới</button> -->
    <div class="form-group text-right">
        <a href="{{route('banner_home.index', ['tour_id' => $tour->id])}}" class="title-upload" target="_blank"><i class="fa fa-arrow-alt-circle-right"></i> {{__('quanlytrangsukien')}}</a>
    </div>
    <div class="item-upload">

        <div class="widget-upload">
            <div class="icon-upload"></div>
            <div class="header-upload">
                <span class="title-upload">{{__('kichhoatgiaidau')}}</span>
            </div>
            <div class="body-upload">
                <div class="view-upload row">
                    <span  class="col-2 col-form-label"><b>{{__('trangthaigiaidau')}}</b></span>
                    <label class="switch">
                        <input n type="checkbox" tour-id="{{$tour->id}}" {{$tour->is_active == 1?'checked':''}} class="slider-status-tour">
                        <span class="slider round"></span>
                    </label>

                    

                    <!-- <button type="button" class="my-btn my-btn-primary " data-toggle="modal" data-target="#changedatetimepicker"> Add</button> -->
                </div>
                <div class="view-upload row">
                <label for="datetimepicker" class="col-2 col-form-label"><b>{{__('hengiokichhoat')}}</b></label>
                    <div >
                        
                        {!! Form::text('timer', "", ['class' => 'form-control', 'data-target' => '#datetimepicker', 'id' => 'datetimepicker', 'style' => 'width: 610px;']) !!}
                    </div>
                </div>



            </div>
        </div>

    </div>

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
                            {!! Form::text('name', $tour->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <b>{!! Form::label('time', __('nam'), ['class' => 'control-label']) !!}</b>
                            {!! Form::text('time', $tour->time, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('name', __('chonsanthidau'), ['class' => 'control-label']) !!}</b>
                            {!! Form::select('facility_id', [32 => $tour->sub_title], $tour->facility_id, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('number_athletic', __('chonsoluongVDV'), ['class' => 'control-label']) !!}</b>
                            {!! Form::number('number_athletic', $tour->number_athletic, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('link_livescore', __('linklivescore'), ['class' => 'control-label']) !!}</b>
                            {!! Form::text('link_livescore', $tour->link_livescore, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>{!! Form::label('name', __('hethonggiai'), ['class' => 'control-label']) !!}</b>
                            {!! Form::select('system_tour_id', $listSystemTour, $tour->system_tour_id, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="list-banner-home">
        @include('cms.manage_tournament.template.item_sponsor_banner', ['title_upload' => __('anhdaidiengiaidau'), 'pos' => 'cover', 'type' => 8, 'listBanner' => $listBanner])
    </div>
    <div class="list-banner-home">
        @include('cms.manage_tournament.template.item_sponsor_banner', ['title_upload' => __('logontt'), 'pos' => 'sponsor', 'type' => 7, 'listBanner' => $listSponsor])
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
                            {!! Form::textarea('describe', $tour->describe, ['class' => 'form-control']) !!}
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
<!-- The Modal  add
<div class="modal" id="changedatetimepicker">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 1200px; width: 640px;">
        <div class="modal-content" style="height: 500px;">

           
            <div class="modal-header">
                <h4 class="modal-title">{{__('themmoivandongvien')}}</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>


            
            <div class="modal-body">

                <div>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker' data-target-input='nearest'>
                            <input type='text' class="form-control datetimepicker-input" data-target="#datetimepicker" id="datetimepicker" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">{{__('luu')}}</button>
            </div>




        </div>
    </div>
</div>
 End The Modal -->

<!-- The Modal  Add giải đấu -->
<div class="modal" id="addtour">
    {!! Form::open(['url' => route('manage_tour.store'), 'method' => 'post', 'enctype'=> "multipart/form-data", 'id' => 'upload_banner']) !!}
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 1200px; width: 1200px;">
        <div class="modal-content" style="height: 1200px;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">{{__('taomoigiaidau')}}</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <div class="wrap-content-page">
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
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <b>{!! Form::label('time', __('nam'), ['class' => 'control-label']) !!}</b>
                                            {!! Form::number('time', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>{!! Form::label('name', __('chonsanthidau'), ['class' => 'control-label']) !!}</b>
                                            {!! Form::select('facility_id', [], null, ['class' => 'form-control select-facility']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>{!! Form::label('number_athletic', __('chonsoluongVDV'), ['class' => 'control-label']) !!}</b>
                                            {!! Form::number('number_athletic', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>{!! Form::label('link_livescore', __('linklivescore'), ['class' => 'control-label']) !!}</b>
                                            {!! Form::text('link_livescore', $tour->link_livescore, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>{!! Form::label('name', __('hethonggiai'), ['class' => 'control-label']) !!}</b>
                                            {!! Form::select('system_tour_id', $listSystemTour, $tour->system_tour_id, ['class' => 'form-control']) !!}
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
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" style="margin: auto;">
                {!! Form::submit('Lưu', ['class' => 'btn btn-success' ]) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<!-- End The Modal Add giải đấu -->
@endsection
@push('style_head')
<link rel="stylesheet" href="{{asset('css/banner_home.css')}}">
@endpush
@push('script_bot')
<script src="/plugin/select2/js/select2.min.js"></script>
<script src="/plugin/select2/js/i18n/vi.js"></script>
<script src="/js/helperImage.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href=" {{asset('css/cms/datetimepicker/bootstrap-datetimepicker.min.css')}}"  type='text/css'>
    <script src="{{asset('css/cms/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script>
    $(document).ready(function() {
        
       
        // let defaultDay =  "{{$tour->timer == NULL ?'':''}}" ;
        let defaultDay = '{{$tour->timer == NULL ? "": $tour->timer}}';
        $('#datetimepicker').datetimepicker({
            useCurrent: false,
            format: 'YYYY/MM/DD HH:mm',
            locale: 'vi',
            sideBySide: true,
            defaultDate: defaultDay,
            // defaultDate: moment("{{$tour->timer}}"),
        });
       
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




        var searchTour = '{{route("searchTour")}}';

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
                data: function(key) {
                    return {
                        keyword: key
                    };
                },
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
            window.location.href = `/cms/manage_tour?tour_id=${id}`;
        });
    });

    $(document).on('change', '.slider-status-tour', function(e) {

        let tour_id = $(this).attr('tour-id');


        var ischecked = $(this).is(":checked");

        if (ischecked) {
            var status = 1;
        } else {
            var status = 0;
        }

        var urlUpdateStatusTour = `/cms/manage_tour/${tour_id}`;

        console.log('uk', urlUpdateStatusTour);

        $.ajax({
            type: 'put',
            url: urlUpdateStatusTour,
            data: {
                tour_id: tour_id,
                is_active: status,
                is_ajax: true
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
</script>
@endpush
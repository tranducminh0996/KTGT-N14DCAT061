@extends('cms.layout.app')
@section('title', 'Quản lý banner home')
@section('content')
    <div class="wrap-content-page">
        <div class="list-banner-home">
            @include('cms.banner.template.item_edit_upload_banner.blade', ['title_upload' => 'Quảng cáo trung tâm bên trên (1300 X 600 Pixel)', 'pos' => 'center-top'])
            @include('cms.banner.template.item_edit_upload_banner', ['title_upload' => 'Quảng cáo cánh trái bên trên (250 X 500 Pixel)', 'pos' => 'left-top'])
            @include('cms.banner.template.item_edit_upload_banner', ['title_upload' => 'Quảng cáo cánh trái bên dưới (250 X 500 Pixel)', 'pos' => 'left-bottom'])
            @include('cms.banner.template.item_edit_upload_banner', ['title_upload' => 'Quảng cáo cánh phải bên trên (250 X 500 Pixel)', 'pos' => 'right-top'])
            @include('cms.banner.template.item_edit_upload_banner', ['title_upload' => 'Quảng cáo cánh phải bên trên (250 X 500 Pixel)', 'pos' => 'right-bottom'])
        </div>

        <div class="list-content-page">

            @include('cms.banner.template.item_edit_select_tour', ['title_upload' => 'Live Score Home', 'name' => 'select-livescore'])
            @include('cms.banner.template.item_edit_select_tour', ['title_upload' => 'Tin giải đấu', 'name' => 'select-news'])
            @include('cms.banner.template.item_edit_select_tour', ['title_upload' => 'Video', 'name' => 'select-video'])
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" ref="{{asset('css/banner_home.css')}}">
@endpush


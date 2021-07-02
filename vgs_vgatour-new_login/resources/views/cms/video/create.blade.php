@extends('cms.layout.app')
@section('title', __('quanlyvideo'))

@section('css-style')
    <link rel="stylesheet" href="{{asset('css/cms/post/post.css')}}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style >
        .dropdown-menu{
            max-width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="post-wrap">
        <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="fa fa-home fa-fw"></i> {{__('trangchu')}} </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#"> {{__('vietbai')}} </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> {{__('thembaiviet')}}</li>
                </ol>
            </nav>
        </div>
        <div class="error">
            @if ($errors->any())
                <div class="info-error arlet">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="app">
            <form method="POST" action="{{route('video.store')}}" accept-charset="UTF-8">
                @csrf
                <div class="note note-success">
                    <p>{{__('bandangchinhsuaphienbantieng')}} "<strong
                            class="current_language_text">{{__('tiengviet')}}</strong>"
                    </p>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="tabbable-custom">
                                <input class="radio" id="one" name="group" type="radio" checked>
                                <input class="radio" id="two" name="group" type="radio">
                                <input class="radio" id="three" name="group" type="radio">
                                <div class="tabs">
                                    <label class="tab" id="one-tab" for="one">{{__('chitiet')}}</label>
                                    <label class="tab" id="three-tab" for="three">{{__('ghichu')}}</label>
                                </div>
                                <div class="panels">
                                    <div class="panel" id="one-panel">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">
                                                {{__('ten')}}
                                            </label>
                                            <input class="form-control input-name" placeholder="{{__('nhapten')}}"
                                                   name="name"
                                                   type="text">
                                            <p class="text-validate validate-name">{{__('tenkhongduocdetrong')}}</p>
                                            <input class="hidden name-slug" type="text" name="slug" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="video_url" class="control-label required">Link Video</label>
                                            <input class="form-control" data-counter="120" name="video_url"
                                                   type="text" value="" id="video_url"
                                                   aria-invalid="false" placeholder="{{__('nhaplinkvideo')}}">
                                            {{--                                            <small class="charcounter">(109 kí tự còn--}}
                                            {{--                                                lại)</small>--}}
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">
                                                {{__('mota')}}
                                            </label>
                                            <textarea class="form-control input-description" name="description"
                                                      cols="50"
                                                      rows="10"></textarea>
                                            <p class="text-validate validate-description">{{__('motakhongduocdetrong')}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="featured" class="control-label">{{__('noibat')}}?</label>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="featured" id="featured" value="1"
                                                       checked="" class="onoffswitch-checkbox form-control">
                                                <label class="onoffswitch-label" for="featured">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home" class="control-label" aria-required="true">
                                                {{__('trangchu')}}?
                                            </label>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="home" class="onoffswitch-checkbox"
                                                       checked="" id="myonoffswitch" value="1">
                                                <label class="onoffswitch-label" for="myonoffswitch">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="order" class="control-label" aria-required="true">
                                                {{__('thutuhienthi')}}
                                            </label>
                                            <input class="form-control featured" placeholder="{{__('thutuhienthi')}}"
                                                   name="order"
                                                   type="number">
                                        </div>
                                        <div class="form-group">
                                            <label for="upload_by" class="control-label upload_by" aria-required="true">
                                                {{__('nguonbaiviet')}}
                                            </label>
                                            <input class="form-control " placeholder="{{__('nguonbaiviet')}}"
                                                   name="post_source"
                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="panel" id="three-panel">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label text-right"
                                                   style="font-size: .8em">{{__('noidungghichu')}}</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="4" name="note" cols="50"
                                                          style="margin-top: 0px; margin-bottom: 0px; height: 151px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="advanced-sortables" class="meta-box-sortables">
                                <div id="seo_wrap" class="widget meta-boxes">
                                    <div class="widget-title">
                                        <h4><span>{{__('tieudehopmeta')}}</span></h4>
                                    </div>
                                    <div class="widget-body">
                                        <a href="#" class="btn-trigger-show-seo-detail">{{__('chinhsuaSEOmeta')}}</a>
                                        <div class="seo-preview">
                                            <p class="default-seo-description">{{__('motaSEOmacdinh')}}</p>
                                            <div class="existed-seo-meta">
                                                <span class="page-title-seo"></span>
                                                <div class="page-url-seo ws-nm">
                                                    <p>
                                                    </p>
                                                </div>
                                                <div class="page-description-seo ws-nm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="seo-edit-section hidden">
                                            <hr>
                                            <div class="form-group">
                                                <label for="seo_title" class="control-label">core.seo-helper::seo-helper.seo_title</label>
                                                <input class="form-control" id="seo_title"
                                                       placeholder="core.seo-helper::seo-helper.seo_title"
                                                       data-counter="120" name="seo_meta[seo_title]" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description" class="control-label">core.seo-helper::seo-helper.seo_description</label>
                                                <textarea class="form-control" rows="3" id="seo_description"
                                                          placeholder="core.seo-helper::seo-helper.seo_description"
                                                          data-counter="155" name="seo_meta[seo_description]"
                                                          cols="50"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 right-sidebar">
                            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                                <div class="widget-title">
                                    <h4>
                                        <span>{{__('xuatban')}}</span>
                                    </h4>
                                </div>
                                <div class="widget-body">
                                    <div class="btn-set">
                                        <button type="submit" name="submit" value="save" class="btn btn-info">
                                            <i class="fa fa-save"></i> {{__('luu')}}
                                        </button>
                                        &nbsp;
                                        <button type="submit" name="submit" value="apply" class="btn btn-success">
                                            <i class="fa fa-check-circle"></i> {{__('luuvachinhsua')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="top-sortables" class="meta-box-sortables">
                                <div id="language_wrap" class="widget meta-boxes">
                                    <div class="widget-title">
                                        <h4><span>{{__('ngonngu')}}</span></h4>
                                    </div>
                                    <div class="widget-body">
                                        <div id="select-post-language">
                                            <table class="select-language-table">
                                                <tbody>
                                                <tr>
                                                    <td class="active-language">
                                                        <img src="https://vgstour.com/vendor/core/images/flags/vn.png"
                                                             title="Tiếng Việt" alt="Tiếng Việt">
                                                    </td>
                                                    <td class="translation-column">
                                                        <div class="ui-select-wrapper">
                                                            <select name="language" id="post_lang_choice"
                                                                    class="ui-select">
                                                                <option value="en_US" data-flag="us">English</option>
                                                                <option value="vi" selected="" data-flag="vn">Tiếng
                                                                    Việt
                                                                </option>
                                                            </select>
                                                            <svg class="svg-next-icon svg-next-icon-size-16">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#select-chevron"></use>
                                                            </svg>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div><strong>{{__('dich')}}</strong>
                                            <div id="list-others-language">
                                                <img src="https://vgstour.com/vendor/core/images/flags/us.png"
                                                     title="English" alt="English">
                                                <a href="https://vgstour.com/admin/posts/create?q=%2Fadmin%2Fposts%2Fcreate&amp;ref_from=0&amp;ref_lang=en_US">
                                                    English <i class="fa fa-plus"></i></a>
                                                <br>
                                            </div>
                                        </div>

                                        <input type="hidden" id="lang_meta_created_from" name="ref_from" value="">
                                        <input type="hidden" id="lang_meta_content_id" value="">
                                        <input type="hidden" id="lang_meta_reference" value="post">
                                        <input type="hidden" id="route_create"
                                               value="https://vgstour.com/admin/posts/create">
                                        <input type="hidden" id="route_edit"
                                               value="https://vgstour.com/admin/posts/edit">
                                        <input type="hidden" id="language_flag_path" value="/vendor/core/images/flags/">

                                        <div
                                            data-change-language-route="https://vgstour.com/admin/settings/languages/change-item-language"></div>

                                        <div id="confirm-change-language-modal" class="modal fade" tabindex="-1"
                                             role="dialog" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog    ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h4 class="modal-title"><i
                                                                class="til_img"></i><strong>{{__('xacnhanthaydoingonngu')}}</strong>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body with-padding">
                                                        {{__('bancochacchanmuonthaydoingonngusangtieng')}} "<strong
                                                            class="change_to_language_text"></strong>"
                                                        ? {{__('dieunayseghidebanghitieng')}} "<strong
                                                            class="change_to_language_text"></strong>" {{__('neunodatontai')}}
                                                        !
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="float-left btn btn-warning" data-dismiss="modal">
                                                            {{__('huybo')}}
                                                        </button>
                                                        <a class="float-right btn btn-warning"
                                                           id="confirm-change-language-button"
                                                           href="#">{{__('xacnhanthaydoi')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="status" class="control-label required"
                                               aria-required="true">{{__('Trạng thái')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <div class="ui-select-wrapper">
                                        <select class="form-control ui-select ui-select" id="status" name="status">
                                            <option value="1">Activated</option>
                                            <option value="0">Deactivated</option>
                                        </select>
                                        <svg class="svg-next-icon svg-next-icon-size-16">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#select-chevron"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="format_type" class="control-label required"
                                               aria-required="true">{{__('dinhdang')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <div class="mt-radio-list">
                                        <label>
                                            <input type="radio" value="1" name="format_type" checked>
                                            New
                                        </label>
                                        <label>
                                            <input type="radio" value="2" name="format_type">
                                            Video
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="format_type" class="control-label required"
                                               aria-required="true">{{__('giaidau')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <select id="tournament-id" class="tournament w-100" data-show-subtext="true" data-live-search="true"
                                            name="tournament">
                                        @if(is_array($getListTournamentOrderByTime) || is_object($getListTournamentOrderByTime))
                                            @foreach($getListTournamentOrderByTime as $item)
                                                <option class="tournament-item" data-id="{{$item->id}}" data-subtext="{{$item->link_livescore}}"
                                                        value="{{$item->id}}">{{$item->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="categories[]" class="control-label required"
                                               aria-required="true">{{__('chuyenmuc')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <div class="form-group form-group-no-margin ">
                                        <div
                                            class="multi-choices-widget list-item-checkbox mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar"
                                            style="position: relative; overflow: visible; padding: 0px;">
                                            <div id="mCSB_1"
                                                 class="mCustomScrollBox mCS-minimal-dark mCSB_vertical_horizontal mCSB_outside"
                                                 tabindex="0" style="max-height: 320px;">
                                                <div id="mCSB_1_container"
                                                     class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y mCS_x_hidden mCS_no_scrollbar_x"
                                                     style="position: relative; top: 0px; left: 0px; width: 219px;"
                                                     dir="ltr">
                                                    <ul>
                                                        <li value="1" class="outline-none">
                                                            <label>
                                                                <input type="radio" value="1" checked=""
                                                                       name="category">
                                                                {{__('videogiaidau')}}
                                                            </label>
                                                        </li>
                                                        <li value="1" class="outline-none">
                                                            <label>
                                                                <input type="radio" value="2" checked=""
                                                                       name="category">
                                                                {{__('videobantingolfnews')}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="mCSB_1_scrollbar_vertical"
                                                 class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical"
                                                 style="display: none;">
                                                <div class="mCSB_draggerContainer">
                                                    <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                                         style="position: absolute; min-height: 50px; height: 0px; top: 0px;"
                                                         oncontextmenu="return false;">
                                                        <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                                    </div>
                                                    <div class="mCSB_draggerRail"></div>
                                                </div>
                                            </div>
                                            <div id="mCSB_1_scrollbar_horizontal"
                                                 class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_horizontal"
                                                 style="display: none;">
                                                <div class="mCSB_draggerContainer">
                                                    <div id="mCSB_1_dragger_horizontal" class="mCSB_dragger"
                                                         style="position: absolute; min-width: 50px; width: 0px; left: 0px;"
                                                         oncontextmenu="return false;">
                                                        <div class="mCSB_dragger_bar"></div>
                                                    </div>
                                                    <div class="mCSB_draggerRail"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="image" class="control-label">{{__('hinhanh')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <div class="image-box">
                                        <div class="preview-image-wrapper ">
                                            <img src="https://vgstour.com/vendor/core/images/placeholder.png"
                                                 alt="preview image" class="preview_image url" width="150">
                                            <a class="btn_remove_image" title="Xoá ảnh">
                                                <i class="fa fa-times" style="margin: 5px"></i>
                                            </a>
                                        </div>
                                        <div class="image-box-actions">
                                            <a href="javascript:void(0)" class="btn_gallery" data-result="image"
                                               data-action="select-image" onclick="openPopup()">
                                                {{__('chonanh')}}
                                            </a>
                                        </div>
                                        <input type="hidden" size="48" name="thumbnail" id="url" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <div class="widget-title">
                                    <h4><label for="tag" class="control-label">{{__('tukhoa')}}</label></h4>
                                </div>
                                <div class="widget-body">
                                    <input placeholder="{{__('themtukhoa') }}" class="input-tag" name="tag" type="text"
                                           value=""
                                           data-role="tagsinput"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-style')
    <script src={{ asset('plugin/ckeditor/ckeditor.js') }}></script>
    <script src={{ asset('js/post/post.js') }}></script>
    <script src="{{asset('plugin/ckfinder/ckfinder.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="{{asset('js/post/bootstrap-tagsinput.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $('.tournament').selectpicker({
            size: 4
        });
    </script>

@endsection



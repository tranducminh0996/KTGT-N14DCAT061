@extends('cms.layout.app')
@section('title', __('quanlytintuc'))

@section('css-style')
<meta name=csrf-token content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('css/cms/post/post.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="post-wrap">
    <div class="breadcrumb-wrap">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('banner_home.index')}}"><i class="fa fa-home fa-fw"></i> {{__('bangdieukhien')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('post.list')}}">{{__('baiviet')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('danhsachbaiviet')}}</li>
            </ol>
        </nav>
    </div>
    <button style="margin-left: 15px" type="button" class="btn btn-primary">
        <a class="add-video-post" href="{{route('post.create')}}">{{__('themmoi')}}</a>
    </button>
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
        @if(session()->has('message_success'))
        <div class="alert-success">
            {{ session()->get('message_success') }}
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="data-table display" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 20px">No</th>
                            <th style="width: 70px">{{__('hinhanh')}}</th>
                            <th style="width: 30%">{{__('ten')}}</th>
                            <th>{{__('thutu')}}</th>
                            <th>{{__('danhmuc')}}</th>
                            <th>{{__('dinhdang')}}</th>
                            <th>{{__('giaidau')}}</th>
                            <th>{{__('ngaytao')}}</th>
                            <th>{{__('trangthai')}}</th>
                            <th style="width: 100px">{{__('tacvu')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


<script type="text/javascript" src="{{asset('js/post/post.js')}}"></script>

<script>
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "url": "/js/datatable/vietnam.json"
            },

            ajax: "{{ route('post.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    className: "uniqueClassName",
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'thumbnail',
                    className: "image-datatable",
                    searching: false,
                    render: function(data, type, row, meta) {
                        return '<img src="' + data + '" class="w-100"/>';
                    }
                },
                {
                    data: 'name',
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='" + oData.url + "'>" + oData.name + "</a>");
                    }
                },
                {
                    data: 'order',
                    searching: false,
                    name: 'order'
                },
                {
                    data: 'category_id',
                    searching: false,
                    name: 'category_id'
                },
                {
                    data: 'format_type',
                    name: 'format_type',    
                    searching: false,             
                    className: "uniqueClassName",
                    "render": function(data) {
                        if (data==1) {
                            return '<span >News</span>';
                        } else {
                            return '<span">Video</span>';
                        }
                    },
                },
                   
                {
                    data: 'tournament_id',
                    name: 'tournament_id'
                },
                {
                    data: 'date_post',
                    name: 'date_post'
                },
                {
                    data: 'status',
                    searching: false,
                    className: "uniqueClassName",
                    "render": function(data) {
                        if (data) {
                            return '<span class="label label-success">Active</span>';
                        } else {
                            return '<span class="label label-danger">Disabale</span>';
                        }
                    },
                    "name": "status",
                    "autoWidth": true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ]
        });
    });
</script>
@endsection
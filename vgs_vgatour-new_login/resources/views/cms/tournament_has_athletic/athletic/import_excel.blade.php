@extends('cms.layout.app')
@section('title', __('quanlybangxephang'))

@section('css-style')
    <meta name=csrf-token content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/cms/post/post.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="post-wrap">
        <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i
                                class="fa fa-home fa-fw"></i> {{__('bangdieukhien')}} </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{__('bangxephang')}}</li>
                </ol>
            </nav>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif


        @if (session()->has('failures'))
            <table class="table table-danger">
                <tr>
                    <th>Row</th>
                    <th>Attribute</th>
                    <th>Errors</th>
                    <th>Value</th>
                </tr>
                @foreach (session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach ($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $validation->values()[$validation->attribute()] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

            <div class="error">
                @if (empty($errors->toArray()) == false)

                <div class="info-error arlet">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert-success">
                        {{ session()->get('success') }}
                    </div>        @endif


            </div>

        <form class="form-excel" action="{{route('athletic.excel.import')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
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
            <div class="excel-wrap">
                <div class="template_excel">
                    <div class="template_excel-wrap">
                        <a class="" href="{{route('excel.template')}}">
                            <img src="{{asset('images/Excel-Logo.jpg')}}">
                            <p class="m-0">{{__('taimaufiletemplateexcel')}}</p>
                        </a>
                    </div>
                </div>
                <div class="form-import">
                    <input id="athletic-file" type="file" name="athletic-file" class="athletic-file"
                           accept=".xlsx, .xls, .csv, .ods">
                    <label class="label-athletic-file" for="athletic-file">
                        <i class="far fa-arrow-alt-circle-up"></i>
                        <p class="m-0">Up file excel</p>
                        <p class="file-name"></p>
                    </label>
                </div>
                <div class="excel-download">
                    <a class="excel-download-link" href="{{route('athletic.excel.export', $tournamentLatest->id)}}">
                        <i class="far fa-arrow-alt-circle-down"></i>
                        <p class="m-0">Xuất file Excel</p>
                    </a>
                </div>
                <button class="btn-submit-excel" type="submit">Lưu</button>
            </div>

        </form>
        <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #b39a13; border-bottom: unset">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        {{__('bancomuonxoavandongviennaykhong')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a style="background: #b39a13" class="btn" id="link-confirm">
                            Xóa
                        </a>
                        <button id="btn-modal-close" style="background: #EEEEEE" type="button" class="btn"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tournament-charts">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" style="width: 5%">Top</th>
                    <th class="text-center" style="width: 5%">ID</th>
                    <th class="text-center" style="width: 25%">{{__('ten')}}</th>
                    <th class="text-center" style="width: 25%">{{__('tienthuong')}}</th>
                    <th class="text-center" style="width: 20%">{{__('thutu')}}</th>
                    <th class="text-center" style="width: 10%">CUT</th>
                    <th class="text-center" style="width: 10%">{{__('thaotac')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($tournamentWithAhtletic !== null)
                    @foreach($tournamentWithAhtletic['athletics'] as $key => $item)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td class="text-center">{{$item->code_athletic}}</td>
                            <td class="text-center">{{$item->first_name . ' ' . $item->last_name}}</td>
                            <td class="text-center">{{number_format($item->total_bonus)}}</td>
                            <td class="text-center">{{$item->ranking}}</td>
                            <td class="text-center">
                                @if($item->is_cut == 1)
                                    OK
                                @else
                                    NOT
                                @endif
                            </td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#modalConfirmDelete"
                                   data-tournamentId="{{$tournamentLatest->id}}"
                                   data-athleticID="{{$item['pivot']['athletic_id']}}"
                                   href="{{route('tournament.ranking.delete', $item->id . '/' . $tournamentLatest->id)}}">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="7" class="text-center">{{__('giaidauchuacodulieu')}}</th>
                    </tr>
                @endif
                </tbody>
            </table>
            {{--            {{dd($tournaments->links())}}--}}
        </div>
    </div>
@endsection

@section('js-style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript" src="{{asset('js/post/post.js')}}"></script>
    <script>
        $('.tournament').selectpicker({
            size: 4
        });

        $('#modalConfirmDelete').on('show.bs.modal', function (e) {
            console.log($(e.relatedTarget).data());
            $('#link-confirm').attr('href', 'http://127.0.0.1:8000/admin/rank/delete/' + $(e.relatedTarget).data('athleticid') + '/' + $(e.relatedTarget).data('tournamentid'));
        })
    </script>
@endsection

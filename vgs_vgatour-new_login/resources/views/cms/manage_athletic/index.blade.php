@extends('cms.layout.app')
@section('title', __('quanlyvandongvien'))
@section('content')
<div class="wrap-content-page">

    @include('cms.manage_athletic.template.view_tab_athletic')

    <button class="my-btn my-btn-primary btn-add-athletic" data-toggle="modal" data-target="#addAthleticModal">+
        Thêm
    </button>


    <div class="table-responsive">
        <table class="table table-athletic">
            <thead class="thead-light">
                <tr>
                    <th>{{__('avatar')}}</th>
                    <th>{{__('hovaten')}}</th>
                    <th>{{__('mahoivien')}}</th>
                    <th>{{__('quoctich')}}</th>
                    <th>{{__('ngaysinh')}}</th>
                    <th>{{__('chieucao')}}</th>
                    <th>{{__('cannang')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $listAthletic as $keyA => $athletic)
                <tr>
                    <td>
                        <img src="{{$athletic->avatar}}" class="avatar-list">
                    </td>
                    <td>{{$athletic->first_name . ' ' . $athletic->last_name}}</td>
                    <td>{{$athletic->code_athletic}}</td>
                    <td>{{$athletic->country_name}}</td>
                    <td>{{$athletic->birthday}}</td>
                    <td>{{$athletic->height}}cm</td>
                    <td>{{$athletic->weight}}kg</td>
                    <td>
                        <button class="btn btnEditModalAthletic" athletic-id="{{$athletic->id}}">
                            <img src="/images/icon_edit_athletic.svg" alt="icon_edit">
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="text-center">
        {{$listAthletic->appends($_GET)->links('vendor.pagination.bootstrap-4')}}
    </div>

    <div class="modal in" id="editModalAthletic">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body wrap-edit-athletic">

                </div>

            </div>
        </div>
    </div>

</div>

<!-- The Modal -->
<div class="modal" id="addAthleticModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__('themmoivandongvien')}}</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            {!! Form::open(['route' => ['manage_athletic.store'], 'method' => 'post', 'enctype'=>"multipart/form-data"]) !!}
            <!-- Modal body -->
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('avatar')}}</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        <div class="text-danger" id="avatar"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('ten')}}</label>
                            <input type="text" class="form-control first-name-athletic" name="first_name" required>
                            <div class="text-danger" id="first_name"></div>

                        </div>
                        <div class="form-group">
                            <label>{{__('vga')}}</label>
                            <input type="number" class="form-control first-name-athletic" name="vga_id" required>
                            <div class="text-danger" id="vga_id"></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', __('quoctich'), ['class' => 'control-label']) !!}
                            <br>
                            {!! Form::select('country', array() , null , ['class' => 'form-control my-select2 select-countryy']) !!}
                            <div class="text-danger" id="country"></div>
                        </div>
                        <div class="form-group">
                            <label>{{__('chieucao')}} (cm)</label>
                            <input type="number" class="form-control first-name-athletic" name="height">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('hovadem')}}</label>
                            <input type="text" class="form-control last-name-athletic" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label>{{__('ngaysinh')}}</label>
                            <input type='text' class="form-control select-date" id="select-birthday" name="birthday" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>{{__('turnpro')}}</label>
                            <input type='text' class="form-control select-date" id="select-turn-pro" name="turn_pro" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>{{__('cannang')}}</label>
                            <input type="number" class="form-control first-name-athletic" name="weight">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="text-danger" id="error"></div>
                <div class="text-success" id="success"></div>
                <button type="submit" class="btn btn-success add-athletic-submit">{{__('luu')}}</button>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
</div>

{{-- <div class="text-center">--}}
{{-- {{$listAthletic->appends($_GET)->links()}}--}}
{{-- </div>--}}
@endsection
@push('style_head')
<link rel="stylesheet" href="{{asset('css/athletic_cms.css')}}">
<link rel="stylesheet" href="/plugin/datepicker/css/bootstrap-datepicker3.min.css">
@endpush
@push('script_bot')
<script src="/plugin/select2/js/select2.min.js"></script>
<script src="/plugin/select2/js/i18n/vi.js"></script>
<script src="/plugin/moment/moment.js"></script>
<script src="/plugin/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/plugin/datepicker/js/bootstrap-datepicker.vi.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.btnEditModalAthletic').on('click', function(e) {

        var athleticId = $(this).attr('athletic-id');

        urlGetInfoAthletic = `/cms/manage_athletic/${athleticId}/edit`;

        $.ajax({
            type: 'get',
            url: urlGetInfoAthletic,

            success: function(response) {

                $('.wrap-edit-athletic').html(response);
                $('#editModalAthletic').modal('show');

            }
        })

    });


    var searchCountry = '{{route("searchCountry")}}';

    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            // formData.append('is_ajax', 'true');
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                enctype: $(this).attr('enctype'),
                data: formData,
                cache: false, // do not cache this request
                contentType: false, // prevent missing boundary string
                processData: false, // do not transform to query string
                timeout: 60000,
                xhr: function() {
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', progressHandler, false);
                    }
                    return xhr;
                },
                success: function(data) {

                    $('#addAthleticModal').modal('hide');
                    Swal.fire({
                        position: "top-right",
                        icon: "success",
                        title: "Thêm mới vận động viên thành công!",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = window.location.href;


                },
                error: function(data) {
                    // $.each(data.responseJSON.error, function(i, item){    
                    //     document.getElementById(i).innerHTML = item;
                    // });
                    let item = data.responseJSON.error;

                    (item.country) ? document.getElementById('country').innerHTML = item.country: document.getElementById('country').innerHTML = ' ';
                    (item.first_name) ? document.getElementById('first_name').innerHTML = item.first_name: document.getElementById('first_name').innerHTML = ' ';
                    (item.vga_id) ? document.getElementById('vga_id').innerHTML = item.vga_id: document.getElementById('vga_id').innerHTML = '  ';
                    (item.avatar) ? document.getElementById('avatar').innerHTML = item.avatar: document.getElementById('avatar').innerHTML = '  ';
                    (item.error) ? document.getElementById('error').innerHTML = item.error: document.getElementById('error').innerHTML = '  ';

                }
            });
            // event.preventDefault();
        });
        // Handle file upload progress
        function progressHandler(event) {
            var percent = 0;
            var position = event.loaded || event.position;
            var total = event.total;
            if (event.lengthComputable) {
                percent = Math.ceil(position / total * 100);
            }
            // display the progress
            // console.log('Uploading ', percent + '%');
        }



        $('.select-countryy').select2({
            language: "vi",
            allowClear: false,
            minimumInputLength: 1,
            placeholder: 'Tìm kiếm',
            ajax: {
                url: searchCountry,
                dataType: 'json',
                type: "GET",
                quietMillis: 50000,
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
        });


        $('#select-turn-pro').datepicker({
            language: "vi",
            format: 'yyyy/mm/dd',
            autoclose: true,
            clearBtn: true
        });

        $('#select-birthday').datepicker({
            language: "vi",
            format: 'yyyy/mm/dd',
            autoclose: true,
            clearBtn: true
        });

        let addViewTimeline = '{{route("addViewTimeline")}}';

        $(document).on('click', '.btn-add-timeline', function() {
            addView();
        })

        function addView(pos, type) {

            $.ajax({
                type: 'get',
                url: addViewTimeline,
                data: {},

                success: function(response) {

                    $('.form-timeline').append(response);

                }
            })
        }
    });
</script>
@endpush
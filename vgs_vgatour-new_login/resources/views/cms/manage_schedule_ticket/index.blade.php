@extends('cms.layout.app')
@section('title', 'Quản lý lịch thi đấu và vé')
@section('content')
    <div class="wrap-content-page">

        <div class="forrm-group" style="width: 25%">
            {!! Form::select('tourSelect', array() , null , ['class' => 'form-control tourSelect', 'style' => 'width: 300px;']) !!}
        </div>

        <div class="ticket-place">
            <div class="item-ticket">
                <div class="widget-ticket">
                    <div class="icon-ticket"></div>
                    <div class="header-ticket">
                        <span class="title-ticket">{{$tour->name}}</span>
                    </div>


                    {!! Form::open(['route' => ['manage_schedule_ticket.update', $tour->id], 'method' => 'put']) !!}

                    <div class="body-ticket">


                        @if (isset($listDate))

                            @foreach($listDate as $keyDate => $date)

                                <div class="item-content-schedule">
                                    <div class="time-detail">
                                        <b>{{\Carbon\Carbon::parse($date->date)->format('d-m-Y')}}</b></div>
                                    <span class="seperate-schedule"></span>
                                    <div class="address-schedule">
                                        <p><b>{{$tour->name . ' day ' . ($keyDate + 1)}}</b></p>
                                        <p><b>{{$tour->sub_title}}</b>{{ ' - ' . $tour->address}}</p>
                                    </div>
                                    <span class="seperate-schedule"></span>

                                    <div class="cost-schedule">
                                        {{--                                        500k VND - Ticket--}}
                                    </div>
                                </div>

                            @endforeach
                        @endif

                    </div>


                    <div class="text-center">
                        {!! Form::submit('Lưu', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

                <button class="btn btn-primary btn-add-ticket" tour="{{$tour->name}}" facility="{{$tour->sub_title}}"
                        address="{{$tour->address}}"> + Thêm
                </button>
            </div>
        </div>
    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/ticket_cms.css')}}">
@endpush
@push('script_bot')
    <script src="/plugin/select2/js/select2.min.js"></script>
    <script src="/plugin/select2/js/i18n/vi.js"></script>
    <script src="/plugin/moment/moment.js"></script>
    <script src="/plugin/datepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/plugin/datepicker/js/bootstrap-datepicker.vi.min.js"></script>
    <script>
        $(document).ready(function () {

            var searchTour = '{{route('searchTour')}}';

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
                    data: function (key) {
                        return {
                            keyword: key
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            }).on("select2:select", function (e) {
                var id = e.params.data.id;
                window.location.href = `/cms/manage_schedule_ticket?tour_id=${id}`;
            });

            $(document).on('click', '.btn-add-ticket', function (e) {

                let tour = $(this).attr('tour')
                let address = $(this).attr('address')
                let facility = $(this).attr('facility')

                addView(tour, address, facility);

            });

            var urlAddView = '{{route('manage_schedule_ticket.addViewTicket')}}'

            function addView(tour, address, facility) {

                $.ajax({
                    type: 'get',
                    url: urlAddView,
                    data: {
                        tour: tour,
                        address: address,
                        facility: facility
                    },

                    success: function (response) {

                        $('.body-ticket').append(response);

                    }
                })
            }

            $('#select-birthday').datepicker({
                language: "vi",
                format: 'yyyy/mm/dd',
                autoclose: true
            });

        });

    </script>
@endpush





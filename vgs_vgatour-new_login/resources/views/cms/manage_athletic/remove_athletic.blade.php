@extends('cms.layout.app')
@section('title', 'Quản lý banner home')
@section('content')
    <div class="wrap-content-page">

        @include('cms.manage_athletic.template.view_tab_athletic')

        <div class="table-responsive">
            <table class="table table-athletic">
                <thead class="thead-light">
                <tr>
                    <th>Avatar</th>
                    <th>Họ và đệm</th>
                    <th>Tên</th>
                    <th>Quốc tịch</th>
                    <th>Ngày sinh</th>
                    <th>Chiều cao</th>
                    <th>Cân nặng</th>
                    <th>Mã hội viên</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td>Avatar</td>
                    <td>Họ và đệm</td>
                    <td>Tên</td>
                    <td>Quốc tịch</td>
                    <td>Ngày sinh</td>
                    <td>Chiều cao</td>
                    <td>Cân nặng</td>
                    <td>Mã hội viên</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editModalAthletic">Edit
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="modal" id="editModalAthletic">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header header-athletic">
                        <button type="submit" class="btn btn-primary submit-edit-athletic">Lưu</button>
                    </div>

                    <div class="modal-body wrap-edit-athletic">

                        <div class="info-detail-athletic">
                            <img src="{{'/images/golfer.png'}}" alt="avatar-athletic" class="avatar-athletic">

                            <div class="info-athletic">
                                <div>
                                    <p class="name-athletic">Trần Lê Duy Nhất </p>
                                    <p class="country-athletic">Vietnam</p>
                                </div>

                                <div class="list-deatail-athletic">
                                    <ul class="list-info-athletic">
                                        <li class="item-info-athletic"><p>Ngày sinh: <b>01-01-1994</b></p></li>
                                        <li class="item-info-athletic"><p>Quốc tịch: <b>Vietnam</b></p></li>
                                        <li class="item-info-athletic"><p>Tham gia Vgatour: <b>01-01-1994</b></p></li>
                                        <li class="item-info-athletic"><p>Turn Pro: <b>1994</b></p></li>
                                        <li class="item-info-athletic"><p>Chiều cao, cân nặng: <b>1m75, 78kg</b></p>
                                        </li>
                                        <li class="item-info-athletic"><p>Tổng tiền thưởng: <b>11.000.000 VND</b></p>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="list-timeline-athletic">
                            <ul>
                                <li><p><b><span class="time-info">1994 </span><span class="describe-info">tại giải vô địch trẻ do VGA tổ chức:</span></b>Bắt
                                        đầu chơi</p></li>
                                <li><p><b><span class="time-info">1994 </span><span class="describe-info">tại giải vô địch trẻ do VGA tổ chức:</span></b>Bắt
                                        đầu chơi</p></li>
                                <li><p><b><span class="time-info">1994 </span><span class="describe-info">tại giải vô địch trẻ do VGA tổ chức:</span></b>Bắt
                                        đầu chơi</p></li>
                                <li><p><b><span class="time-info">1994 </span><span class="describe-info">tại giải vô địch trẻ do VGA tổ chức:</span></b>Bắt
                                        đầu chơi</p></li>
                                <li><p><b><span class="time-info">1994 </span><span class="describe-info">tại giải vô địch trẻ do VGA tổ chức:</span></b>Bắt
                                        đầu chơi</p></li>
                            </ul>

                            <button class="btn btn-secondary"> + Thêm</button>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/athletic_cms.css')}}">
@endpush


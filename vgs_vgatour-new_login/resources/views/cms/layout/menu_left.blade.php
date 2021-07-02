{{--<style>--}}
{{--    .sidenav {--}}
{{--        height: 100%;--}}
{{--        /*position: fixed;*/--}}
{{--        /*z-index: 1;*/--}}
{{--        /*top: 0;*/--}}
{{--        /*left: 0;*/--}}
{{--        overflow-x: hidden;--}}
{{--        padding-top: 20px;--}}
{{--    }--}}

{{--    /* Style the sidenav links and the dropdown button */--}}
{{--    .sidenav a, .dropdown-btn {--}}
{{--        padding: 6px 8px 6px 16px;--}}
{{--        text-decoration: none;--}}
{{--        font-size: 20px;--}}
{{--        color: #818181;--}}
{{--        display: block;--}}
{{--        border: none;--}}
{{--        background: none;--}}
{{--        width: 100%;--}}
{{--        text-align: left;--}}
{{--        cursor: pointer;--}}
{{--        outline: none;--}}
{{--    }--}}

{{--    .sidenav a:hover, .dropdown-btn:hover {--}}
{{--        color: #f1f1f1;--}}
{{--    }--}}

{{--    .active {--}}
{{--        color: white;--}}
{{--    }--}}

{{--    .dropdown-container {--}}
{{--        display: none;--}}
{{--        background-color: #262626;--}}
{{--        padding-left: 8px;--}}
{{--    }--}}

{{--    /* Optional: Style the caret down icon */--}}
{{--    .fa-caret-down {--}}
{{--        float: right;--}}
{{--        padding-right: 8px;--}}
{{--    }--}}

{{--    /* Some media queries for responsiveness */--}}
{{--    @media screen and (max-height: 450px) {--}}
{{--        .sidenav {--}}
{{--            padding-top: 15px;--}}
{{--        }--}}

{{--        .sidenav a {--}}
{{--            font-size: 18px;--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}

<aside class="col-12 col-md-2 p-0 bg-dark flex-shrink-1">

    {{--    <div class="sidenav">--}}
    {{--        <a href="#about">Quản lý trang Home</a>--}}
    {{--        <a href="#services">Quản lý  giải đấu</a>--}}
    {{--        <a href="#clients">Clients</a>--}}
    {{--        <a href="#contact">Contact</a>--}}
    {{--        <button class="dropdown-btn">Dropdown--}}
    {{--            <i class="fas fa-caret-down fa-w-18"></i>--}}
    {{--        </button>--}}
    {{--        <div class="dropdown-container">--}}
    {{--            <a href="#">Link 1</a>--}}
    {{--            <a href="#">Link 2</a>--}}
    {{--            <a href="#">Link 3</a>--}}
    {{--        </div>--}}
    {{--        <a href="#contact">Search</a>--}}
    {{--    </div>--}}
    <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
        <div class="collapse navbar-collapse ">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('banner_home.index')}}"><i class="fa fa-home fa-fw"></i>
                        <span class="d-none d-md-inline">{{__('quanlytranghome')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('manage_tour.index')}}"><i class="fa fa-golf-ball fa-fw"></i>
                        <span
                            class="d-none d-md-inline">{{__('quanlygiaidau')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('manage_schedule_ticket.index')}}"><i
                            class="fa fa-ticket-alt fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('quanlylichthidauvave')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('manage_athletic.index')}}"><i class="fas fa-blind"></i>
                        <span class="d-none d-md-inline">{{__('quanlyvandongvien')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('video.list')}}"><i class="fas fa-video"></i><span
                            class="d-none d-md-inline">{{__('quanlyvideo')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('post.list')}}">
                        <i class="far fa-newspaper"></i>
                        <span class="d-none d-md-inline">{{__('quanlytintuc')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route("galleries.index") }}"><i class="far fa-images"></i> <span
                            class="d-none d-md-inline">{{__('quanlythuvienanh')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{route('tournament.ranking')}}"><i class="fa fa-columns fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('quanlybangxephang')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-ad fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('quanlyquangcao')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-random fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('quanlytuongtac')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fas fa-hand-holding-usd"></i> <span
                            class="d-none d-md-inline">{{__('quanlynhataitro')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fas fa-exclamation-triangle"></i> <span
                            class="d-none d-md-inline">{{__('canhbao')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-star codeply fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('thongkesolieu')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="far fa-money-bill-alt"></i> <span
                            class="d-none d-md-inline">{{__('quanlyquyettoangiaidau')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fas fa-donate"></i> <span
                            class="d-none d-md-inline">{{__('quanlybangchiatienthuong')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fas fa-file-contract"></i> <span
                            class="d-none d-md-inline">{{__('quanlyhopdonggiaidau')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-language codeply fa-fw"></i> <span
                            class="d-none d-md-inline">{{__('quanlyngonngu')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#" style="color: #cf0000"><i class="fas fa-sign-out-alt"></i> <span
                            class="d-none d-md-inline">{{__('dangxuat')}}</span></a>
                </li>
            </ul>
        </div>
    </nav>


</aside>

{{--<script>--}}
{{--    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */--}}
{{--    var dropdown = document.getElementsByClassName("dropdown-btn");--}}
{{--    var i;--}}

{{--    for (i = 0; i < dropdown.length; i++) {--}}
{{--        dropdown[i].addEventListener("click", function () {--}}
{{--            this.classList.toggle("active");--}}
{{--            var dropdownContent = this.nextElementSibling;--}}
{{--            if (dropdownContent.style.display === "block") {--}}
{{--                dropdownContent.style.display = "none";--}}
{{--            } else {--}}
{{--                dropdownContent.style.display = "block";--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}

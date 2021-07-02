<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/style_cms.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('plugin/awesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/select2/css/select2.min.css')}}">

    <!-- datetimepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href=" {{asset('css/cms/datetimepicker/bootstrap-datetimepicker.min.css')}}"  type='text/css'>
    <script src="{{asset('css/cms/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script> -->

    <!-- <link href="js\lightGallery\lightgallery.min.css" rel="stylesheet">
    <script src="js\lightGallery\lightgallery.min.js"></script> -->


    @yield('css-style')
    <script type="text/javascript">
        window.baseUrl = '{{ url(' / ') }}';
        window.token = '{{ csrf_token() }}';
    </script>
    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('../../fonts/Roboto-Regular.ttf');
        }

        * {
            font-family: Roboto !important;
        }

        .alert {
            position: absolute;
            width: 30%;
            text-align: center;
            top: 90%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('style_head')

</head>

<body>
    <div class="my-navbar">
        <a class="navbar-brand" href="javascript:void(0)">
            <img class="my-logo" src="{{asset('/images/logo.svg')}}" alt=""></a>
    </div>
    <div id="app">
        <div class="main" style="background-color: white;">
            <div class="container-fluid">
                <div class="row min-vh-100 flex-column flex-md-row">
                    @include('cms.layout.menu_left')

                    <main class="col bg-faded py-3 flex-grow-1">
                        @yield('content')
                    </main>
                </div>
            </div>

        </div>
    </div>
    @include('flash::message')
    <div class="alert alert-success" role="alert" style="display: none;">

    </div>
    @stack('script_bot')
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}

    <script src="{{ asset('/js/cms/app.js') }}"></script>
    <script src="{{ asset('/js/cms/app-vue.js') }}"></script>
    <script defer src="/plugin/awesome/js/all.js" crossorigin="anonymous"></script>
    <script>
        $('div.alert').not('.alert-important').delay(3500).fadeOut(350);
    </script>

    @yield('js-style')
</body>

</html>
<?php
$leftTop = '';
$leftBottom = '';
$rightTop = '';
$rightBottom = '';

foreach ($listBanner as  $banner) {
    if ($banner->type == 2) {
        $leftTop = '<div>
        <a target="_blank" href="{{$banner->url}}">
            <img class="item-banner" src="' . $banner->link_image . '" alt="">
        </a>
    </div>';
    }
    if ($banner->type == 3) {
        $leftBottom = '<div>
        <a target="_blank" href="{{$banner->url}}">
            <img class="item-banner" src="' . $banner->link_image . '" alt="">
        </a>
    </div>';
    }
    if ($banner->type == 4) {
        $rightTop = '<div>
        <a target="_blank" href="{{$banner->url}}">
            <img class="item-banner" src="' . $banner->link_image . '" alt="">
        </a>
    </div>';
    }
    if ($banner->type == 5) {
        $rightBottom = '<div>
        <a target="_blank" href="{{$banner->url}}">
            <img class="item-banner" src="' . $banner->link_image . '" alt="">
        </a>
    </div>';
    }
}


?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4b21224f7b.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/css/lightgallery.min.css" integrity="sha512-lbDC4wu0k+iHGJZbBPNieYRUaQ0e61l1thTr9MgjY3lwCWFXHv6/nIuK+F4p2yln5+4AOLCwPL/b0uGjXMPyMg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/css/lg-zoom.min.css" integrity="sha512-SGo05yQXwPFKXE+GtWCn7J4OZQBaQIakZSxQSqUyVWqO0TAv3gaF/Vox1FmG4IyXJWDwu/lXzXqPOnfX1va0+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/css/lg-thumbnail.min.css" integrity="sha512-wHHBD+hSImJWcX192FT77uzFT4pVJDZ5sTiVYE3cArMtIix9lycXS0lvuLwRVyyFQO4pTj7MKxSuFKFMVzjK2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/css/lightgallery-bundle.min.css" integrity="sha512-Sg6/ETzjZfcuzu/KmKRj79kxj2o40cNSTtnc0igt6vT2IAhUt6UstDveJGvWa3sEr27BgWgsA7S4sGCYi78siA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/css/lg-zoom.min.css" integrity="sha512-SGo05yQXwPFKXE+GtWCn7J4OZQBaQIakZSxQSqUyVWqO0TAv3gaF/Vox1FmG4IyXJWDwu/lXzXqPOnfX1va0+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.8.1/js/jquery.justifiedGallery.min.js" integrity="sha512-8dQZtymfQeDiZ4bBCFhrKZhDcZir15MqnEDBRiR6ReIVHLcdnCyJrhPIS0QifLGuMkFZsw9QMNeD9JtiLwieTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.8.1/css/justifiedGallery.min.css" integrity="sha512-CRFv/YVJyElHXTiMgnhWKd2f04Hd/BUJkwcyqYmlpL1ugSYW23nNRazLk960mlz7dugTrETCGGjcsnspPOS6qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/plugins/zoom/lg-zoom.min.js" integrity="sha512-CzWOJg3vGGr7inDGGOAJF9uNWCpP6Tw/qGip+bekzIj9ZlgFGZqXYZahFqH29eSbsz9xRb7UcUdbQpOMIKWOtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('../../fonts/Roboto-Regular.ttf');
        }

        * {
            font-family: Roboto !important;
        }
        .gallery-item {
  width: 200px;
  padding: 5px;
}

    </style>

    @stack('style_head')

</head>

<body>
    @include('layout.header')
    <div class="main">

        <div class="banner-place left-banner d-none d-md-block">
            <?php
                echo $leftTop . $leftBottom;
            ?>
        </div>
        @yield('content')
        <div class="banner-place right-banner d-none d-md-block">
        <?php
                echo $rightTop . $rightBottom;
            ?>
        </div>

    </div>

    <div class="clearfix"></div>
    @include('layout.footer')
</body>
@stack('script_bot')

</html>
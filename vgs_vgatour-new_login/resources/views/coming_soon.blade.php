<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VGA Tour</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body class="antialiased">
<div style="text-align:center; background-color: #333333">
    <img src="{{asset('images/banner_pc.svg')}}" alt="" style="height: 100%; width: auto" class="d-none d-md-block">
    <img src="{{asset('images/banner_mb.svg')}}" alt="" style="height: 100%; width: auto" class="d-md-none">
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
        <!-- Style -->
        <link  rel="stylesheet" href="{{asset('css/bootstrap.min.css', true)}}">
        <link  rel="stylesheet" href="{{asset('css/animate.css', true)}}">
        <link rel="stylesheet" href="{{asset('css/all.min.css', true)}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css', true)}}">
        <link  rel="stylesheet" href="{{asset('css/style.css', true)}}">
        <!-- Core -->
        <script src="{{asset('js/jquery-3.6.0.min.js', true)}}"></script>
        <title>Yommotsu Pay</title>
    </head>
    <body>
        <div id="pay-statistic">

        </div>
        @vite('resources/js/apps/statistic.js')
    </body>
</html>

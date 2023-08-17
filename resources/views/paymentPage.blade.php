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
        <div id="pay">

        </div>
        <script src="{{asset( 'js/wow.min.js', true)}}"></script>
        <script>
            new WOW().init();
            window.blade_data = {!! json_encode($data) !!};
            console.log(window.blade_data);
        </script>
        @vite('resources/js/app.js')
    </body>
</html>

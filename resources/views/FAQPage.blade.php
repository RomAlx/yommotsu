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
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link  rel="stylesheet" href="{{asset('css/style.css', true)}}">
        <!-- Core -->
        <script src="{{asset('js/jquery-3.6.0.min.js', true)}}"></script>
        <script src="//code.jivo.ru/widget/8WzK4qFtD8" async></script>
        <title>Yommotsu</title>
    </head>
    <body>
        <div id="faq" data-csrf-token="{{ csrf_token() }}">

        </div>
        <script src="{{asset( 'js/wow.min.js', true)}}"></script>
        <script>
            new WOW().init();
        </script>
        @vite('resources/js/apps/faq.js')
    </body>
</html>

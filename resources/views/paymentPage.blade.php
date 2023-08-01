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
        <section>
            <div class="container">
                <div class="tg_wrap">
                    <div class="tg_cont text-center">
                        <div class="row">
                            <div class="col">
                                <div class="card payment-card">
                                    <div class="row align-items-center">
                                        <div class="col-8 pay-col">
                                            <small class="text-name">Название проекта</small>
                                            <h5 class="text-fill">{{$project_name}}</h5>
                                            <small class="text-name">Номер карты</small>
                                            <h5 class="text-fill">{{$bank_number}}</h5>
                                            <small class="text-name">Владелец</small>
                                            <h5 class="text-fill">{{$name}}</h5>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <img src="{{asset('img/logo.png')}}" alt="Logo" class="logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a class="button" style="margin-top: 5vh; margin-bottom: 5vh;" href={{$url}}>Я оплатил!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

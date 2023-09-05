<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Статус</title>

    <style>
      body, html {
          background: rgb(255,255,255);
          background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(226,226,226,1) 100%); 
      }
      @font-face {
          font-family: 'Montserrat-Regular';
          src: url('../fonts/montserrat/Montserrat-Regular.ttf') format('truetype');
      }
      @font-face {
          font-family: 'Montserrat-SemiBold';
          src: url('../fonts/montserrat/Montserrat-SemiBold.ttf') format('truetype');
      }
      .text-center {
          text-align: center !important;
      }
      .order-card{
        margin: 1rem;
        padding: 2rem;
        min-height: 80vh;
        height: 80%;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
      }
    </style>
</head>
<body>
    <div class="order-card container">
        <p class="warning-label">Ваш заказ</p>
        <div class="row justify-content-start">
          <div class="col-3"><p class="fix-top warning-field-name">Проект</p></div>
          <div class="col-9"><p class="fix-top warning-field-value">{{ $project_name }}</p></div>
        </div>
        <div class="row justify-content-start">
          <div class="col-3"><p class="fix-top warning-field-name">Email</p></div>
          <div class="col-9"><p class="fix-top warning-field-value">{{ $email }}</p></div>
        </div>
        <div class="row justify-content-start">
          <div class="col-3"><p class="fix-top warning-field-name">Имя</p></div>
          <div class="col-9"><p class="fix-top warning-field-value">{{ $name }}</p></div>
        </div>
        <div class="row justify-content-start">
          <div class="col-3"><p class="fix-top warning-field-name">Сумма</p></div>
          <div class="col-9"><p class="fix-top warning-field-value">{{ $amount }}</p></div>
        </div>
        <div class="row justify-content-start">
          <div class="col-3"><p class="fix-top warning-field-name">Заказ</p></div>
          <div class="col-9"><p class="fix-top warning-field-value">{{ $order_id }}</p></div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3"><p class="fix-top warning-field-name">Статус</p></div>
            <div class="col-9"><p class="fix-top warning-field-value">{{ $status }}</p></div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3"><p class="fix-top warning-field-name">Создан</p></div>
            <div class="col-9"><p class="fix-top warning-field-value">{{ $created_at }}</p></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
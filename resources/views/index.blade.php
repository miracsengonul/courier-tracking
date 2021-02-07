<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nöbetçi Marketçi</title>
    <meta name="description" content="Malatya'nın Sanal Marketi. Yan işimiz değil asıl işimiz sanal market !">
    <meta name="keywords" content="malatya sanal market, malatya market,malatya market alışverişi,malatya online market,malatya kapıya market,malatya market sanal">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #ED454D;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .form-control{
            display: revert;
            width: 70%;
        }
        .white{
            color: white;
        }
        .form-control{
            color: black;
            font-weight: bold;
        }
        .form-control::placeholder{
            color: black;
            font-weight: bold;
        }
        .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover{
            background-color: transparent;
            border-bottom: dashed 2px black;
            font-weight: bold;
        }
        @media only screen and (min-width: 320px) and (max-width: 479px){ .img-margin-left{margin-left: 75px} .img-size{ width: 45%}}

        @media only screen and (min-width: 480px) and (max-width: 767px){ .img-margin-left{margin-left: 110px} .img-size{ width: 25%}}

        @media only screen and (min-width: 768px) and (max-width: 991px){ .img-margin-left{margin-left: 130px} .img-size{ width: 30%}}

        @media only screen and (min-width: 992px){ .img-margin-left{margin-left: 130px} .img-size{ width: 20%}}
    </style>
    <meta name="robots" content="noindex">
</head>
<body style="background-color: #ED454D;overflow-x:hidden">

<nav class="navbar navbar-default" style="background-color: #ED454D;border:#ED454D;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="color: white">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand white" href="#" style="color: yellow;font-weight: bold">kurye.live</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#" style="color:#fff;">Anasayfa</a></li>
                <li><a href="#" style="color: white">Restoran Başvuru</a></li>
                <li><a href="#" style="color: white">İletişim</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login" style="color: white;font-weight: bold"><span class="glyphicon glyphicon-log-in"></span> Restoran Giriş</a></li>
            </ul>
        </div>
    </div>
</nav>





<div class="flex-center position-ref full-height pagination-centered">
    <div class="content">
        <div class="title m-b-md">
            <img src="{{asset('images/logo4.png')}}" class="img-responsive img-margin-left img-size" style=";margin-left: auto;margin-right: auto">
        </div>

        <div style="color: white">
            <h1><strong>kurye.live</strong></h1>
        </div>
        <hr style="width:80%;color:#fff;border:dashed 2px">
        <div class="row">
            <form id="form">
                <div class="col-xs-12">
                    <img src="{{asset('images/icon/bell.png')}}" width="64">
                    <h3 style="color: yellow;font-size: 19px;font-weight: 600">Lütfen Önce Bildirim İçin İzin Verin !</h3>
                    <p style="color: white;font-weight:bold">Daha önce kaydolduysanız tekrar olmanıza gerek yoktur.</p>
                </div>

                <div class="col-xs-12" style="text-align: center;margin-top: 25px">
                    <input type="tel" name="phone" class="form-control phone" placeholder="Telefon Numaranız: 538 555 55 55" style="height: 45px;">
                </div>

                <div class="col-xs-12" style="margin-top:25px;color:white;font-weight:bold">
                    <p style="color:black;font-weight: 600">- Neden Kayıt Olmam Gerekiyor ?</p>
                    <p>Anlaşmalı restoranlarımızdan sipariş verdiğiniz taktirde siparişinizi harita
                        üzerinden anlık olarak takip etmek için herhangi bir uygulama indermeden bildirim alacaksınız.</p>
                    <br>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="one_signal_user_id" id="one-signal-user-id" value="" />
                    <input class="btn btn-default btn-lg save-data" type="submit" value="Gönder">
                </div>
            </form>
        </div>
        <div class="message-place" style="display: none">
            <div class="alert alert-danger">
                <p class="message"></p>
            </div>
        </div>
    </div>
</div>
<script>
    //TODO onesignal entegresi olmadığı için kod hata veriyor ve ajax çalışmıyor normal olarak. Entegrasyondan sonra teyit edilecek tekrar
    $(document).ready(function(){
        $('.phone').mask('(000) 000 00 00');

        //Eğer onesignal izni verdiyse
        OneSignal.push(function() {
            OneSignal.getUserId(function(userId) {
                console.log("OneSignal User ID:", userId);
                document.getElementById("one-signal-user-id").value = userId

                //userId(playerId) oluşturulduysa
                if (userId !== null) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(".save-data").click(function (event) {
                        event.preventDefault();
                        // telefon kaydederken formun içindeki hem phone hem de one_signal_user_id değerini müşteri bilgisi olarak kaydet.
                        $.ajax({
                            url: "{{route('savePhone')}}",
                            type: "POST",
                            data: $('#form').serialize(),
                            success: function (response) {
                                console.log(response);
                                if (response) {
                                    $('.row').css("display", "none");
                                    $('.message-place').css("display", "block");
                                    $('.message').text(response.msg);
                                }
                            },
                        });
                    });
                }

        });

    });
</script>
</body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="../public/css/chooseGoodTypePage.css" rel="stylesheet" type="text/css">
</head>
<body>
@if (Route::has('login'))
    <div class="top-right">
        @if (Auth::check())
            <a href="{{ url('/home') }}"><span class="links">Профиль</span></a>
        @else
            <a href="{{ url('/login') }}"><span class="links">Войти</span></a>
            <a href="{{ url('/register') }}"><span class="links">Зарегистрироваться</span></a>
        @endif
    </div>
@endif
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-4 logo-name text-center text-warning">Аукцион</h1>
            </div>
        </div>
    </div>
</div>
<div class="py-0 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img class="img-fluid d-block logo mx-auto w-50" src="../resources/images/logo.png"> </div>
        </div>
    </div>
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="buildingMaterials" class="btn btn-outline-primary w-100 text-center btn-sm good-type-btn text-white text-uppercase">
                    Новый аукцион
                </a>
            </div>
        </div>
    </div>
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($uniq_auctions as $auction)
                    <div class="order link">
                        <a href="showAuction/car{{$auction['car_id']}}/category{{$auction['category_id']}}/district{{$auction['district_id']}}"
                           class="btn btn-outline-primary w-100 text-center btn-sm good-type-btn text-white text-uppercase">
                            Товар: {{$auction['category_name']}}<br>Машина: {{$auction['car_name']}}<br>Район: {{$auction['district_name']}}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
            <a href="{{ url('/home') }}"><span class="links">Home</span></a>
        @else
            <a href="{{ url('/login') }}"><span class="links">Login</span></a>
            <a href="{{ url('/register') }}"><span class="links">Register</span></a>
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
                    Строительные материалы
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          type="text/css">
    <link rel="stylesheet" href="../../../css/auctionPage.css" type="text/css">

</head>

<body>

<?php $user = \Illuminate\Support\Facades\Auth::user() ?>
@if (Auth::check())
    <a href="{{ url('/home') }}"><span class="links">Профиль</span></a>
@else
    <a href="{{ url('/login') }}"><span class="links">Войти</span></a>
    <a href="{{ url('/register') }}"><span class="links">Зарегистрироваться</span></a>
@endif
<div class="py-3 my-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-warning text-center">Аукцион</h1>
            </div>
        </div>
    </div>
</div>
<div class="my-0 py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-warning">Машина: <span class="text-white">{{$car->name}}</span></p>
                <p class="lead text-warning my-0">Товар: <span class="text-white">{{$category->name}}</span></p>
                <p class="lead text-warning my-1">Район: <span class="text-white">{{$district->name}}</span></p>
            </div>
        </div>
    </div>
</div>
<div class="my-0 py-0">
    <div class="container">
        <div class="row col-xs-12">
            <div class="col-xs-4 sellsers">
            </div>
            <div class="col-xs-4" id="drawing">

            </div>
            <div class="col-xs-4 buyers">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/updateAuction.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/showLocation.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/svg.js') !!}"></script>
<script>
   var carId = '{{$car->id}}';
   var carName = '{{$car->name}}'
   var categoryId = '{{$category->id}}';
   var categoryName = '{{$category->name}}';
   var districtId = '{{$district->id}}';
   var districtName = '{{$district->name}}';
   var userId = '-1';
   var userRole = ''
   @if (Auth::check())
     userId = '{{$user->id}}';
     userRole = '{{$user->role}}';
   @endif
</script>
</body>

</html>
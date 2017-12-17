{{--<html>--}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/selfPage.css" type="text/css">
    <title></title>
</head>

<body>
<?php $user = Illuminate\Support\Facades\Auth::user();?>

<div class="py-2 my-0">
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
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="category">
            Категория: {{$category}}
        </div>
        <div class="car">
            Машина: {{$car}}
        </div>
        <div class="district">
            Категория: {{$district}}
        </div>
        <div class="row">
            <div class="col-xs-6">Имя</div>
            <div class="col-xs-6">Номер</div>
        </div>
        <div class="row">
            <div class="col-xs-6">{{$name}}</div>
            <div class="col-xs-6">{{$phone}}</div>
        </div>
        <div>
            <a href="my_wins">Мои аукционы</a>
        </div>
    </div>
</div>

<script type="text/javascript" src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/myWins.js') !!}"></script>
<script>
    var userId = '{{$user->id}}';
</script>
</body>

{{--</html>--}}
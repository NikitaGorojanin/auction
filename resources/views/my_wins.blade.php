<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/selfPage.css" type="text/css"> </head>

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
    <div class="container-fluid">
        @if(count($my_auctions) > 0)
            <div class="row">
                <div class="col-xs-3">Товар</div>
                <div class="col-xs-3">Машина</div>
                <div class="col-xs-3">Район</div>
                {{--@if($user_role == 'buyer')--}}
                    {{--<div class="col-xs-2">Имя продавца</div>--}}
                    {{--<div class="col-xs-2">Номер продавца</div>--}}
                {{--@else--}}
                    {{--<div class="col-xs-2">Имя покупателя</div>--}}
                    {{--<div class="col-xs-2">Номер покупателя</div>--}}
                {{--@endif--}}
                <div class="col-xs-3">Цена</div>
            </div>
            @foreach($my_auctions as $auc)
                <div class="row">
                    <div class="col-xs-3">{{$auc->category_name}}</div>
                    <div class="col-xs-3">{{$auc->car_name}}</div>
                    <div class="col-xs-3">{{$auc->district_name}}</div>
                    <div class="col-xs-3">{{$auc->price}}</div>
                </div>
            @endforeach
        @else
            <div>У Вас пока нет выигранных аукционов</div>
        @endif
    </div>
</div>

<script type="text/javascript" src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/myWins.js') !!}"></script>
<script>
    var userId = '{{$user->id}}';
</script>
</body>

</html>
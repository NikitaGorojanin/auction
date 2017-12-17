<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>

<style>
    html, body {
        background-color: rgba(34, 34, 34, 0.76);
        color: #48a4ff;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .category{
        text-align: center;
    }

    .categories{
        width: 100%;
        border-spacing: 15px;
    }

    .button{
        color: #2fff34;
    }

    .top-right{
        width: 100%;
        text-align: right;
    }

    .links{
        color: #48a4ff;
        margin-right: 20px;
    }

    a{text-decoration: none;}
</style>

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
<center><H1>Категории товаров</H1></center>
<?php $rowCnt=ceil(count($categories)/3); $remain = count($categories) - 3*floor(count($categories)/3);
$remainStartIndex = count($categories)-$remain;?>
<table class="categories">
@for($rows=0; $rows < $rowCnt-1; $rows++)
<tr>
    @for($i=0; $i<3; $i++)
        <td>
            <div class="category">
                <div class="category_name">{{$categories[$rows*3+$i]->name}}</div>
                <img src='../resources/images/{{$categories[$rows*3+$i]->image_path}}'}>
                <div class="buttons">
                    <a href="sell{{$categories[$rows*3+$i]->id}}"><span class="button">Продаю</span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="buy{{$categories[$rows*3+$i]->id}}"><span class="button">Покупаю</span></a>
                </div>
            </div>
        </td>
    @endfor
</tr>
@endfor
<tr>
    @for($i=0; $i<$remain; $i++)
        <td>
            <div class="category">
                <div class="category_name">{{$categories[$remainStartIndex+$i]->name}}</div>
                <img src='../resources/images/{{$categories[$remainStartIndex+$i]->image_path}}'>
                <div class="buttons">
                    <a href="sell{{$categories[$rows*3+$i]->id}}"><span class="button">Продаю</span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="buy{{$categories[$rows*3+$i]->id}}"><span class="button">Покупаю</span></a>
                </div>
            </div>
        </td>
    @endfor
</tr>
</table>
</body>
</html>
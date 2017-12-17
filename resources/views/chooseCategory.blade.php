<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/chooseCategoryGoodPage.css" type="text/css"> </head>

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
                <h3 class="text-warning text-center">Выбор категории товара</h3>
            </div>
        </div>
    </div>
</div>
@foreach($categories as $category)
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($car != "[]")
                    <a class="btn w-100 btn-secondary text-primary"
                       href="chooseDistrictAndSetPrice\car{{$car->id}}\category{{$category->id}}">
                        {{$category->name}}
                    </a>
                @else
                    <a class="btn w-100 btn-secondary text-primary" href="chooseCarAfterCategory{{$category->id}}">
                        {{$category->name}}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
</body>

</html>
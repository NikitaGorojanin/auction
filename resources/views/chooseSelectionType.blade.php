<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/chooseSelectTypePage.css" type="text/css"> </head>

<body class="">
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
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-warning text-center head">С чего начнёте?</h1>
            </div>
        </div>
    </div>
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn w-100 select-car-btn btn-secondary text-primary" href="chooseCar">Выбрать транспортное средство</a>
            </div>
        </div>
    </div>
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn w-100 select-good-category-btn text-primary btn-secondary" href="chooseCategory">Выбрать категорию товара</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>
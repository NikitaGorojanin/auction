<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../../public/css/chooseDistrictAndSetPricePage.css" type="text/css">
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
                <h3 class="text-warning text-center">Аукционы</h3>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="../../goToSelectedAuction/car{{$car->id}}/category{{$category->id}}" class="form">
<div class="py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="lead text-warning">Машина: <span class="text-white">{{$car->name}}</span></p>
            </div>
            <div class="col-md-6">
                <p class="lead text-warning">Товар: <span class="text-white">{{$category->name}}</span></p>
            </div>
            <div class="col-md-6">
                <p class="lead text-warning">Введите цену: <input type="number" name="price" id="price"> </p>
            </div>
            @if (Auth::check())
                @if (Auth::user()->role == "buyer")
                    <div class="col-md-6">
                        <p class="lead text-warning">Вы можете выбрать Вашу локацию на карте:
                            <img class="location" src="../../../resources/images/location32.png">
                            <input type="hidden" name="location" class="longlat">
                        </p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@foreach($districts as $district)
<div class="py-3 my-0 w-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="district" value="{{$district->id}}_{{$district->name}}"
                                class="btn btn-secondary text-primary w-100 text-center districts">
                    {{$district->name}}
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ csrf_field() }}
</form>
<script type="text/javascript" src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/checkPrice.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/showMapForLocationSetting.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/checkPrice.js') !!}"></script>
<script>
    var userRole = '{{Auth::user()->role}}';
</script>
</body>
</html>
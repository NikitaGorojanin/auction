<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/selfPage.css" type="text/css"> </head>

<body>
<a href="{{ url('/logout') }}">Logout</a>
<div class="py-2 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-warning">{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
            </div>
        </div>
    </div>
</div>
<!--<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-4">
                <img src="https://pingendo.com/assets/photos/user_placeholder.png" class="rounded-circle img-fluid mx-auto d-block">
                <a class="btn w-100 m-1 btn-sm btn-secondary text-primary" href="#">Добавить товар</a>
            </div>
            <div class="col-md-6 col-7">
                <h4 class="text-warning py-0 my-0 text-center">Товары</h4>
                <p class="text-white  py-0 my-0 bg-info"><span class="text-warning">Машина:</span> Зил <span class="text-warning">Товар:</span> Кирпич <span class="text-warning">Статус:</span> Ожидается подтверждение</p>
                <p class="text-white"><span class="text-warning">Машина:</span> Зил <span class="text-warning">Товар:</span> Клинец <span class="text-warning">Статус:</span> Товар выставлен</p>
            </div>
        </div>
    </div>
</div>
<div class="py-0 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-warning">Активные аукционы:</p>
                <p class="text-white">Бектимир. Место: 4 Минимальная цена: 8000</p>
                <p class="text-white">Юнусобад. Место: 2 Минимальная цена: 9000</p>
                <p class="text-white bg-danger">Яшнобад. Ожидание ответа от покупателя</p>
            </div>
        </div>
    </div>
</div>
<div class="py-0 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-warning">Не активные аукционы:</p>
                <p class="text-white">Мирзо-Улугбек. Минимальная цена: 7000</p>
                <p class="text-white">Чилонзар. Минимальная цена: 9500</p>
            </div>
        </div>
    </div>
</div>-->
</body>

</html>
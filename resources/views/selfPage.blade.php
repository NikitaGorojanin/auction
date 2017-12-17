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
    <a href="../public/logout">Выйти</a>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-warning">{{$user->name}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-4">
                <img src="https://pingendo.com/assets/photos/user_placeholder.png" class="rounded-circle img-fluid mx-auto d-block">
                <a class="btn w-100 m-1 btn-sm btn-secondary text-primary" href="buildingMaterials">Добавить товар</a>
                <a class="btn w-100 m-1 btn-sm btn-secondary text-primary" href="my_wins">Выигранные аукционы</a>
            </div>
            <div class="col-md-6 col-7">
                <h4 class="text-warning py-0 my-0 text-center">Товары</h4>
                <div class="goods">
                    <!--<p class="text-white  py-0 my-0 bg-info"><span class="text-warning">Машина:</span> Зил <span class="text-warning">Товар:</span> Кирпич <span class="text-warning">Статус:</span> Ожидается подтверждение</p>
                    <p class="text-white"><span class="text-warning">Машина:</span> Зил <span class="text-warning">Товар:</span> Клинец <span class="text-warning">Статус:</span> Товар выставлен</p>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-0 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="auction_header"></div>
                <div class="auctions">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/selfPage.js') !!}"></script>
<script>
    var userId = '{{$user->id}}';
</script>
</body>

</html>
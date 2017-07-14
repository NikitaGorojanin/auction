<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>
    <style>
        html{
            background-color: rgba(34, 34, 34, 0.76);
            color: #48a4ff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        a{
            text-decoration: none;
            color: white;
        }
        .goods{
            margin-bottom: 30px;
        }
        .link{
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
<h1>{{$user->name}}</h1>
<div>
    <img src="../resources/images/user.png">
</div>
<div>
    <span class="goods_title">Ваши товары</span>
    <div class="goods">
    @foreach($goods as $good)
        <div class="good link"><a href="showAuction/category/{{$good->category_id}}/car/{{$good->cars_id}}/district/{{$good->district_id}}">
        {{$good->category_name}} {{$good->car_name}} {{$good->district_name}}
            </a></div>
    @endforeach
    </div>
    <span class="orders_title">Ваши заказы</span>
    <div class="orders">
    @foreach($orders as $order)
        <div class="order link"><a href="showAuction/category/{{$order->category_id}}/car/{{$order->cars_id}}/district/{{$order->district_id}}">
            {{$order->category_name}} {{$order->car_name}} {{$order->district_name}}
            </a></div>
    @endforeach
    </div>
</div>
</body>
</html>


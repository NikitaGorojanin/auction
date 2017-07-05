<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>

    <style>
        html {
            background-color: rgba(34, 34, 34, 0.76);
            color: #48a4ff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .sellers{
            float: left;
            width: 50%;
            text-align: center;
        }
        .buyers{
            float:right;
            width: 50%;
            text-align: center;
        }

        .title{
            color: #2fff34;
        }

        .item{
            margin-bottom: 15px;
            margin-top: 15px;

        }

        .text{
            color: #2fff34;
        }
    </style>

</head>
<body>
<H1>{{$category->name}}</H1>
<div class="sellers">
    <H2><span class="sellers_title title">Продавцы</span></H2>
    @foreach($goodsWithUsers as $gwu)
        <div class="good item">
            <div class="name"><?=$gwu->name?></div>
            <div class="priceAndpercent">
                <span class="price">
                    <span class="text">Цена: </span><?=$gwu->price?>
                </span>
                <span class="percent">
                    <span class="text">Процент: </span><?=$gwu->price*0.02?>
                </span>
            </div>
        </div>
    @endforeach
</div>
<div class="buyers">
    <H2><span class="buyers_title title">Покупатели</span></H2>
    @foreach($ordersWithUsers as $owu)
        <div class="order item">
            <div class="name"><?=$owu->name?></div>
            <div class="priceAndpercent">
                <span class="price">
                    <span class="text">Цена: </span><?=$owu->price?>
                </span>
                <span class="percent">
                    <span class="text">Процент: </span><?=$owu->price*0.02?>
                </span>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
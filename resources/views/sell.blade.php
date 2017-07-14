<!doctype html>
<html lang="{{ app()->getLocale() }}">
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

        #container{
            padding-left: 20px;
        }

        .btn{
            margin-top: 10px;
        }
    </style>

</head>
<body>
<center><H1>Продажа товара</H1></center>
<div id="container">
<H2>{{$category->name}}</H2>
<img src='../resources/images/{{$category->image_path}}'>
<form method="POST" action="addCategoryGood{{$category->id}}">

        <div>Ваше транспортное средство</div>
        <div>
            <select name="car" class="form-control">
                @foreach($cars as $car)
                    <option value="{{$car->id}}">{{$car->name}}</option>
                @endforeach
            </select>
        </div>
        <div>Выберите районы доставки</div>
        <div>
            @foreach($districts as $district)
                    <div>
                        <input type="checkbox" name="district{{$district->id}}" value="{{$district->id}}">{{$district->name}}
                        <input type="text" name="price{{$district->id}}" pattern="\d+(\.\d{2})?">
                    </div>
            @endforeach
        </div>
        <div>
            <button type="submit" name="sell" class="btn btn-primary">Выставить товар</button>
        </div>
    {{ csrf_field() }}
</form>
</div>
</body>
</html>
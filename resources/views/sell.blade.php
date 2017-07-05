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

        <div>Введите цену вашего товара</div>
        <div>
            <textarea name="price" class="form-control"></textarea>
        </div>
        <div>Введите описание вашего товара</div>
        <div>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div>Выберите фото товара</div>
        <div>
            <textarea name="image_path" class="form-control"></textarea>
        </div>
        <div>
            <button type="submit" name="sell" class="btn btn-primary">Выставить товар</button>
        </div>
    {{ csrf_field() }}
</form>
</div>
</body>
</html>
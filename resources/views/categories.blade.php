<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>

<style>
    html, body {
        background-color: #AA00FF;
        color: #FF0000;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }
</style>

</head>
<body>
@foreach($categories as $category)
    <div class="category">{{$category->name}}</div><br>
    @endforeach
</body>
</html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../../public/css/chooseDistrictAndSetPricePage.css" type="text/css">
</head>
<body>
<div class="py-3 my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-warning text-center">Аукционы</h3>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="../../goToSelectedAuction/car{{$car->id}}/category{{$category->id}}">
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
                <p class="lead text-warning">Введите цену: <input type="number" name="price" class="price"> </p>
            </div>
        </div>
    </div>
</div>
@foreach($districts as $district)
<div class="py-3 my-0 w-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="district" value="{{$district->id}}_{{$district->name}}" class="btn btn-secondary text-primary w-100 text-center">
                    {{$district->name}}
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ csrf_field() }}
</form>
</body>
</html>
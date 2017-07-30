<?php

namespace App\Http\Controllers;
use App\Category;
use App\Good;
use App\Order;
use App\Car;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    //
    public function showAllCarModel(Category $category)
    {
        $cars = Car::all();
        return view('chooseCar', compact('cars', 'category'));
    }
}

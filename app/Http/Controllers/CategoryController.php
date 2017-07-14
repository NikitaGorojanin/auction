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

class CategoryController extends Controller
{
    //
    public function showAllCategories(){
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function showSellForm(Category $category){
        $cars = Car::all();
        $districts = District::all();
        return view('sell', compact('category', 'cars', 'districts'));
    }

    public function showBuyForm(Category $category){
        $cars = Car::all();
        $districts = District::all();
        return view('buy', compact('category', 'cars', 'districts'));
    }

    public function saveNewGood(Request $request, Category $category){
        if(Auth::check()) {
            //file_put_contents("../resources/testLog.txt", $request);
            $districts = array();
            if(isset($request->district1))
                $districts[] = array(1,$request->price1);
            if(isset($request->district2))
                $districts[] = array(2,$request->price2);
            if(isset($request->district3))
                $districts[] = array(3,$request->price3);
            if(isset($request->district4))
                $districts[] = array(4,$request->price4);
            if(isset($request->district5))
                $districts[] = array(5,$request->price5);
            if(isset($request->district6))
                $districts[] = array(6,$request->price6);
            if(isset($request->district7))
                $districts[] = array(7,$request->price7);
            if(isset($request->district8))
                $districts[] = array(8,$request->price8);
            if(isset($request->district9))
                $districts[] = array(9,$request->price9);
            if(isset($request->district10))
                $districts[] = array(10,$request->price10);
            if(isset($request->district11))
                $districts[] = array(11,$request->price11);

            for($i=0;$i<count($districts);$i++)
            {
                $good = new Good();
                $good->description = "";
                $good->image_path = "";
                $good->category_id = $category->id;
                $good->user_id = Auth::id();
                $good->cars_id = $request->car;
                $good->district_id = $districts[$i][0];
                $good->price = $districts[$i][1];
                $good->save();
            }
            return redirect("/userProfile");
        }
        else {
            return redirect('/');
        }
    }

    public function saveNewOrder(Request $request, Category $category){
        if(Auth::check()){
            $order = new Order();
            $order->price = $request->price;
            $order->category_id = $category->id;
            $order->user_id = Auth::id();
            $order->cars_id = $request->car;
            $order->district_id = $request->district;
            $order->save();
            //return view('goodsOrdersInCategory', $this->getAllGoodsAndOrdersForCategory($category));
            return redirect("/userProfile");
        }
        else {
            return redirect('/');
        }
    }

    public function showUserProfile()
    {
        $user = Auth::user();
        $goods = DB::table('goods')
                    ->join('categories', 'goods.category_id','=','categories.id')
                    ->join('cars', 'goods.cars_id','=','cars.id')
                    ->join('districts', 'goods.district_id','=','districts.id')
                    ->where('goods.user_id','=',$user->id)
                    ->select('goods.*', 'categories.name as category_name', 'cars.name as car_name',
                        'districts.name as district_name')
                    ->get();

        $orders = DB::table('orders')
            ->join('categories', 'orders.category_id','=','categories.id')
            ->join('cars', 'orders.cars_id','=','cars.id')
            ->join('districts', 'orders.district_id','=','districts.id')
            ->where('orders.user_id','=',$user->id)
            ->select('orders.*', 'categories.name as category_name', 'cars.name as car_name',
                'districts.name as district_name')
            ->get();


        return view('home', compact('user', 'goods', 'orders'));
    }

    public function showAuction(Category $category, Car $car, District $district)
    {
        return view('goodsOrdersInCategory', $this->getAllGoodsAndOrdersForAuction($category, $car, $district));
    }

    private function getAllGoodsAndOrdersForAuction(Category $category, Car $car, District $district) {
        $goodsWithUsers = DB::table('goods')
            ->join('users', 'goods.user_id','=','users.id')
            ->where([
                ['goods.category_id','=',$category->id],
                ['goods.cars_id','=',$car->id],
                ['goods.district_id','=',$district->id]
            ])
            ->select('goods.*', 'users.*')
            ->get();

        $ordersWithUsers = DB::table('orders')
            ->join('users', 'orders.user_id','=','users.id')
            ->where([
                ['orders.category_id','=',$category->id],
                ['orders.cars_id','=',$car->id],
                ['orders.district_id','=',$district->id]
            ])
            ->select('orders.*', 'users.*')
            ->get();

        return compact('goodsWithUsers', 'ordersWithUsers', 'category', 'car', 'district');
    }


    /*public function showCategoryAuction(Category $category, Car $car, District $district)
    {
        return view('goodsOrdersInCategory', $this->getAllGoodsAndOrdersForCategory($category));
    }

    private function getAllGoodsAndOrdersForCategory(Category $category) {
        $goodsWithUsers = DB::table('goods')
                            ->join('users', 'goods.user_id','=','users.id')
                            ->where('goods.category_id','=',$category->id)
                            ->select('goods.*', 'users.*')
                            ->get();

        $ordersWithUsers = DB::table('orders')
            ->join('users', 'orders.user_id','=','users.id')
            ->where('orders.category_id','=',$category->id)
            ->select('orders.*', 'users.*')
            ->get();

        return compact('goodsWithUsers', 'ordersWithUsers', 'category');
    }

    public function saveNewOrderAndShowCategory(Request $request, Category $category){
        if(Auth::check()){
            $order = new Order();
            $order->price = $request->price;
            $order->category_id = $category->id;
            $order->user_id = Auth::id();
            $order->save();
            return view('goodsOrdersInCategory', $this->getAllGoodsAndOrdersForCategory($category));
        }
        else {
            return redirect('/');
        }
    }*/
}

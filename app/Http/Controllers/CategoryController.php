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
            $good = new Good();
            $good->description = "";
            $good->image_path = "";
            $good->category_id = $category->id;
            $good->user_id = Auth::id();
            $good->cars_id = $request->car;
            $good->price = $request->price;
            $good->district_id = $request->district;
            $good->save();

            return redirect("/categoryAuction".$category->id);
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
            return redirect("/categoryAuction".$category->id);
        }
        else {
            return redirect('/');
        }
    }

    public function showCategoryAuction(Category $category)
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
    }
}

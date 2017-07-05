<?php

namespace App\Http\Controllers;

use App\Category;
use App\Good;
use App\Order;
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
        return view('sell', compact('category'));
    }

    public function showBuyForm(Category $category){
        return view('buy', compact('category'));
    }

    public function saveNewGoodAndShowCategory(Request $request, Category $category){
        if(Auth::check()) {
            $good = new Good();
            $good->description = $request->description;
            $good->image_path = $request->image_path;
            $good->category_id = $category->id;
            $good->user_id = Auth::id();
            $good->price = $request->price;
            $good->save();
            return view('goodsOrdersInCategory', $this->getAllGoodsAndOrdersForCategory($category));
        }
        else {
            return redirect('/');
        }
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

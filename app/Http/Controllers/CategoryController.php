<?php

namespace App\Http\Controllers;

use App\Category;
use App\Good;
use Illuminate\Http\Request;

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

    public function saveNewGoodAndShowCategory(Request $request, Category $category){
        $good = new Good();
        $good->description = $request->description;
        $good->image_path = $request->image_path;
        $good->category_id = $category->id;
        $good->user_id = 1;
        $good->price = $request->price;
        $good->save();
    }
}

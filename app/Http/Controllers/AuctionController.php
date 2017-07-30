<?php

namespace App\Http\Controllers;
use App\Category;
use App\Good;
use App\Order;
use App\Car;
use App\District;
use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response;

class AuctionController extends Controller
{
    //
    public function showAllDistricts(Car $car, Category $category)
    {
        $districts = District::all();
        return view('chooseDistrictAndSetPrice', compact('car', 'category', 'districts'));
    }

    public function isUserInThisAuction($car_id, $category_id, $district_id)
    {
        $user = Auth::user();
        $check = DB::table('auctions')
                    ->where([
                        ['car_id', '=', $car_id],
                        ['category_id', '=', $category_id],
                        ['district_id', '=', $district_id],
                        ['user_id', '=', $user->id],
                        ['deleted', '=', 0]
                    ])
                    ->select('*')
                    ->get();
        return ($check->count()>0);
    }

    public function goToAuction(Request $request, Car $car, Category $category){
       if(Auth::check()) {
           if(isset($request->district)) {
               $user = Auth::user();
               list($districtId, $districtName) = explode("_", $request->district, 2);
               if(!$this->isUserInThisAuction($car->id, $category->id, $districtId)) {
                   $auction = new Auction();
                   $auction->car_id = $car->id;
                   $auction->car_name = $car->name;
                   $auction->category_id = $category->id;
                   $auction->category_name = $category->name;
                   $auction->district_id = $districtId;
                   $auction->district_name = $districtName;
                   $auction->user_id = $user->id;
                   $auction->user_name = $user->nickname;
                   $auction->user_role = $user->role;
                   $auction->price = $request->price;
                   $auction->deleted = 0;
                   $auction->save();
               }
               return redirect("showAuction/car".$car->id."/category".$category->id."/district".$districtId);
           }
           else
               return redirect("chooseDistrictAndSetPrice/car".$car->id."/category".$category->id);
        }else{
            return redirect()->guest('login');
        }
    }

    public function showAuctionPage(Car $car, Category $category, District $district){
        return view('auctionPage', compact('car', 'category', 'district'));
    }

    public function getSalersAndBuyersListInAuction(Request $request){
        $auctionParticipants = DB::table('auctions')
                                    ->where([
                                        ['car_id', '=', $request->carId],
                                        ['category_id', '=', $request->categoryId],
                                        ['district_id', '=', $request->districtId],
                                        ['deleted', '=', 0]
                                    ])
                                    ->orderBy('price', 'asc')
                                    ->select('*')
                                    ->get();
        $salers = array();
        $buyers = array();
        foreach ($auctionParticipants as $ap)
        {
            if($ap->user_role == 'saler')
                $salers[] = $ap;
            else
                $buyers[] = $ap;
        }
        $response = array(
            'salers'=>$salers,
            'buyers'=>$buyers,
        );
        echo \response()->json($response);
    }

    public function setNewPrice(Request $request)
    {
        if(Auth::check())
        {
            $userId = Auth::user()->id;
            $result = DB::table('auctions')
                ->where([
                    ['car_id', '=', $request->carId],
                    ['category_id', '=', $request->categoryId],
                    ['district_id', '=', $request->districtId],
                    ['user_id', '=', $userId],
                    ['deleted', '=', 0]
                ])
                ->update(['price' => $request->price]);
            echo $result;
        }
        else
            return redirect()->guest('login');
    }
}

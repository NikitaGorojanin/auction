<?php

namespace App\Http\Controllers;
use App\Category;
use App\Good;
use App\Order;
use App\Car;
use App\District;
use App\Auction;
use App\BuyerChooseGood;
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

               $location = $request->location;
               $lat=0;
               $lng=0;
               if(strlen($location)!=0) {
                   $coord = explode("_", $location, 2);
                   $lat = $coord[0];
                   $lng = $coord[1];
               }

               $price = $request->price;
               if(strlen($price)==0)
                   $price = 0;
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
                   $auction->user_phone = $user->contacts;
                   $auction->user_role = $user->role;
                   $auction->price = $price;
                   $auction->latitude = $lat;
                   $auction->longitude = $lng;
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

    public function getSellersAndBuyersListInAuction(Request $request){
        if ($request->userRole == 'buyer'){
            $my_lot = DB::table('auctions')
                            ->where([
                                ['car_id', '=', $request->carId],
                                ['category_id', '=', $request->categoryId],
                                ['district_id', '=', $request->districtId],
                                ['user_id', '=', $request->userId],
                                ['accepted_by_buyer', '=', 0]
                            ])
                            ->select('*')
                            ->first();

            if($my_lot != null && $my_lot->partner_lot_id != 0){
                $seller = DB::table('auctions')
                    ->where([
                        ['id', '=', $my_lot->partner_lot_id],
                        ['partner_lot_id', '=', $my_lot->id]
                    ])
                    ->select('*')
                    ->first();

                DB::table('auctions')
                    ->where([
                        ['car_id', '=', $request->carId],
                        ['category_id', '=', $request->categoryId],
                        ['district_id', '=', $request->districtId],
                        ['user_id', '=', $request->userId],
                        ['accepted_by_buyer', '=', 0]
                    ])
                    ->update(['accepted_by_buyer'=>1]);

                $car = $seller->car_name;
                $category = $seller->category_name;
                $district = $seller->district_name;
                $name = $seller->user_name;
                $phone = $seller->user_phone;
                return response()->json(['goToContacts'=>true, 'data'=>['carName'=>$car, 'categoryName'=>$category, 'districtName'=>$district,
                    'name'=>$name, 'phone'=>$phone]]);
            }
        }

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

        $buyersChoices = DB::table('buyer_choose_goods')
            ->where([
                ['car_id', '=', $request->carId],
                ['category_id', '=', $request->categoryId],
                ['district_id', '=', $request->districtId],
                ['deleted', '=', 0]
            ])
            ->select('*')
            ->get();

        $salers = array();
        $buyers = array();
        foreach ($auctionParticipants as $ap)
        {
            if($ap->user_role == 'seller')
                $salers[] = $ap;
            else
                $buyers[] = $ap;
        }
        $response = array(
            'sellers'=>$salers,
            'buyers'=>$buyers,
            'buyerChoises'=>$buyersChoices
        );
        echo response()->json(['goToContacts'=>false, 'data'=>$response]);
    }

    public function setBuyerAccepted($lot_id){
        //setBuyerAccepted = 1
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

    public function IsChoiceExistInBase($carId, $categoryId, $districtId, $sallerOrderId, $buyerOrderId){
        $check = DB::table('buyer_choose_goods')
            ->where([
                ['car_id', '=', $carId],
                ['category_id', '=', $categoryId],
                ['district_id', '=', $districtId],
                ['seller_order_id', '=', $sallerOrderId],
                ['buyer_order_id', '=', $buyerOrderId],
                ['deleted', '=', 0]
            ])
            ->select('*')
            ->get();
        return ($check->count()>0);
    }

    public function setBuyerChooseSeller(Request $request){
        if(Auth::check()) {
            if(!$this->IsChoiceExistInBase($request->carId, $request->categoryId, $request->districtId,
                $request->sallersOrderId, $request->buyersOrderId)) {
                $buyerChooseGood = new BuyerChooseGood();
                $buyerChooseGood->buyer_order_id = $request->buyersOrderId;
                $buyerChooseGood->seller_order_id = $request->sellersOrderId;
                $buyerChooseGood->category_id = $request->categoryId;
                $buyerChooseGood->car_id = $request->carId;
                $buyerChooseGood->district_id = $request->districtId;
                $buyerChooseGood->deleted = 0;
                $buyerChooseGood->save();
            }
            else
                return redirect()->guest('login');
        }
    }


    public function removeBuyerChoise(Request $request)
    {
        if(Auth::check()) {
            DB::table('buyer_choose_goods')
                ->where([
                    ['car_id', '=', $request->carId],
                    ['category_id', '=', $request->categoryId],
                    ['district_id', '=', $request->districtId],
                    ['buyer_order_id', '=', $request->buyersOrderId]
                ])
                ->delete();
            //return view('partnerContacts', compact('car', 'category', 'district'));
        }
        else
            return redirect()->guest('login');
    }


    public function finishAuctionAndShowContactPage(Request $request)
    {
        if(Auth::check()) {
            DB::table('buyer_choose_goods')
                ->where([
                    ['car_id', '=', $request->carId],
                    ['category_id', '=', $request->categoryId],
                    ['district_id', '=', $request->districtId],
                    ['seller_order_id', '=', $request->sellerOrderId],
                ])
                ->delete();

            DB::table('auctions')
                ->where([
                    ['id', '=', $request->sellerOrderId],
                    ['deleted', '=', 0]
                ])
                ->update(['partner_lot_id' => $request->buyerOrderId,
                         'deleted' => 1]);

            DB::table('auctions')
                ->where([
                    ['id', '=', $request->buyerOrderId],
                    ['deleted', '=', 0]
                ])
                ->update(['partner_lot_id' => $request->sellerOrderId,
                         'deleted' => 1]);

            $buyer = DB::table('auctions')
                        ->where([
                            ['id', '=', $request->buyerOrderId],
                            ['deleted', '=', 1]
                        ])
                        ->select('*')
                        ->first();

            if ($buyer != null) {
                $car = $request->carName;
                $category = $request->categoryName;
                $district = $request->districtName;
                $name = $buyer->user_name;
                $phone = $buyer->user_phone;

                return response()->json(['carName'=>$car, 'categoryName'=>$category, 'districtName'=>$district,
                                            'name'=>$name, 'phone'=>$phone]);
            }
            else{
                return response()->json(['carName'=>'Something wrong', 'categoryName'=>'Something wrong', 'districtName'=>'Something wrong',
                    'name'=>'Something wrong', 'phone'=>'Something wrong']);
            }
        }
        else
            return redirect()->guest('login');
    }

    public function goToPartnerContactsPage(Request $request){
        $category = $request->categoryName;
        $car = $request->carName;
        $district = $request->districtName;
        $name = $request->name;
        $phone = $request->phone;
        //$result = $request->session()->all();//получаем данные из сессии
//        $token = $result['_token'];
        return view('partner_contacts', compact('category', 'car', 'district', 'name', 'phone'));
    }

    public function getMyClosedAuctions(Request $request){
        if(Auth::check()) {
            $userId = Auth::user()->id;
            $dataAboutMyClosedAuctions = DB::table('deals')
                ->where('buyer_id', '=', $userId)
                ->orWhere('seller_id', '=', $userId)
                ->select('*')
                ->get();

            echo \response()->json($dataAboutMyClosedAuctions);
        }
        else return redirect()->guest('login');
    }


    public function sellerAcceptDeal(){

    }

    public function showMyAuctions(){
        if (Auth::check())
        {
            $user = Auth::user();
            $userId = $user->id;
            $user_role = $user->role;
            $my_auctions = DB::table('auctions')
                    ->where([
                        ['user_id', '=', $userId],
                        ['deleted', '=', 1]
                    ])
                    ->select('*')
                    ->get();
            return view('my_wins', compact('my_auctions', 'user_role'));
        }
        else return redirect()->guest('login');
    }
}

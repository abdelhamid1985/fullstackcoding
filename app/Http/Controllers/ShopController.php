<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shops\shop;
use Session;
use DB;

class ShopController extends Controller
{
    
    public function index(Request $request) {
        $userIP = request()->ip();
        $userID = auth()->user()->id;
        $locationDetails = json_decode( 
                file_get_contents( 
                        "http://api.ip2location.com/?ip={$userIP}&key=demo&package=WS10&format=json", 
                        true
                        )
                );
        $userLat = $locationDetails->latitude;
        $userlong = $locationDetails->longitude;
        
        $sql = "select id, name, city_name, region_name, country_name, longitude, latitude, address from shop";
        $sql .= " where id not in ( select shop_id from markbook where user_id = $userID )";
        $sql .= " order by (POW((longitude - $userlong),2) + POW((latitude - $userLat),2));";
        $allShops = DB::select($sql);
                
        $columns = [
            "name", "City", "Region", "Country", "Lat", "Long", "Address"
        ];
        $params = [
            "userip" => $userIP, 
            "locationDetails" => $locationDetails,
            "allShops" => $allShops,
            "columns" => $columns
                ];
                        
        return view("welcome", $params);   
    }
    
    /*
     * Likes a shop, add it to favorits shops list
     */
    public function likeShop(Request $request) {
        $userID = auth()->user()->id;
        $shopID = $request->get("shopID");
        
        DB::table("blacklist")->where("shop_id", $shopID)->where("user_id", $userID)->delete();
        DB::table("markbook")
                ->insert([
                    ["user_id" => $userID, "shop_id" => $shopID, "created_by" => $userID]
                ]);
        
        die("Shop with id " . $shopID . " added to your favorits list");
    }
    
    /*
     * List favorits shops
     */
    public function favList(Request $request){
        $userIP = request()->ip();
        $userID = auth()->user()->id;
        $locationDetails = json_decode( 
                file_get_contents( 
                        "http://api.ip2location.com/?ip={$userIP}&key=demo&package=WS10&format=json", 
                        true
                        )
                );
        $userLat = $locationDetails->latitude;
        $userlong = $locationDetails->longitude;
        
        $sql = "select id, name, city_name, region_name, country_name, longitude, latitude, address from shop";
        $sql .= " where id in ( select shop_id from markbook where user_id = $userID ) ";
        $sql .= " order by (POW((longitude - $userlong),2) + POW((latitude - $userLat),2));";
        
        $allShops = DB::select($sql);
                
        $columns = [
            "name", "City", "Region", "Country", "Lat", "Long", "Address"
        ];
        $params = [
            "userip" => $userIP, 
            "locationDetails" => $locationDetails,
            "allShops" => $allShops,
            "columns" => $columns
                ];
                        
        return view("welcome", $params); 
    }    
    
    /*
     * Dislike a shop add it to blacklist
     */
    public function dislikeShop(Request $request) {
        $userID = auth()->user()->id;
        $shopID = $request->get("shopID");
        
        DB::table("markbook")->where("shop_id", $shopID)->where("user_id", $userID)->delete();
        DB::table("blacklist")
                ->insert([
                    ["user_id" => $userID, "shop_id" => $shopID, "created_by" => $userID]
                ]);
        
        die("Shop with id " . $shopID . " added to your blacklist");
    }
    
    /*
     * List blacklisted shops
     */
    public function blacklist(Request $request){
        $userIP = request()->ip();
        $userID = auth()->user()->id;
        $locationDetails = json_decode( 
                file_get_contents( 
                        "http://api.ip2location.com/?ip={$userIP}&key=demo&package=WS10&format=json", 
                        true
                        )
                );
        $userLat = $locationDetails->latitude;
        $userlong = $locationDetails->longitude;
        
        $sql = "select id, name, city_name, region_name, country_name, longitude, latitude, address from shop";
        $sql .= " where id in ( select shop_id from blacklist where user_id = $userID ) ";
        $sql .= " order by (POW((longitude - $userlong),2) + POW((latitude - $userLat),2));";
        $allShops = DB::select($sql);
                
        $columns = [
            "name", "City", "Region", "Country", "Lat", "Long", "Address"
        ];
        $params = [
            "userip" => $userIP, 
            "locationDetails" => $locationDetails,
            "allShops" => $allShops,
            "columns" => $columns
                ];
                        
        return view("welcome", $params); 
    }    
    
}

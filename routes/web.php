<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#_ Dashboard
    Route::get("/", "ShopController@index")->middleware('auth')->name("shop.index");

#_ Auth
    Route::get("login", "authController@login")->name("login");
    Route::get("logout", "authController@logout")->name("logout");
    Route::post("signup", "authController@signup")->name("register");
    Route::post("authenticate", "authController@authenticate")->name("auth.authenticate");
    
#_Shop
    #> Like shop
    Route::post("favorits/like", "ShopController@likeShop")->name("shops.like-shop");
    Route::get("favorits/list", "ShopController@favList")->name("shop.favorits");
    #> black list
    Route::post("blacklist/dislike", "ShopController@dislikeShop")->name("shops.dislike-shop");
    Route::get("blacklist/list", "ShopController@blacklist")->name("shop.blacklist");
    
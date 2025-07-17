<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PartnersController;
Route::get('/', function () {
    $pageTitle="dashboard";
    return view('dashboard');
});

//for restaurants //////////////////////////////////////////////////////
Route::get('/dashboard/restaurants',[PartnersController::class,'index_restaurants']);
Route::get('/dashboard/restaurants/add',[PartnersController::class,'add_restaurants']);
Route::post('/dashboard/restaurants/add/p',[PartnersController::class,'post_restaurants']);
Route::delete('/dashboard/restaurants/add/p/{id}',[PartnersController::class,'delete_restaurants']);
Route::get('/dashboard/restaurants/edit/{id}',[PartnersController::class,'edit_restaurants']);
Route::put('/dashboard/restaurants/add/p/{id}',[PartnersController::class,'update_restaurants']);
//for Hotels  //////////////////////////////////////////////////////
Route::get('/dashboard/hotels',[PartnersController::class,'index_hotels']);
Route::get('/dashboard/hotels/add',[PartnersController::class,'add_hotels']);
Route::post('/dashboard/hotels/add/p',[PartnersController::class,'post_hotels']);
Route::delete('/dashboard/hotels/add/p/{id}',[PartnersController::class,'delete_hotels']);
Route::get('/dashboard/hotels/edit/{id}',[PartnersController::class,'edit_hotels']);
Route::put('/dashboard/hotels/update/p/{id}',[PartnersController::class,'update_hotels']);



Route::get('/admin', function () {
    return view('admin');
});

Route::get('/api1', function () {
    return json_encode(['name'=>'api','message'=>'Hi',"nbr"=>1]);
});

Route::get('/book', [TestController::class,'index']);


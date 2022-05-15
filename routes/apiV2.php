<?php

use App\Http\Middleware\LoadingAuthentication;
use Illuminate\Support\Facades\Route;


Route::namespace('Api\V2')->middleware(LoadingAuthentication::class)->group(function () {

    Route::post('/loading', 'LoadingController@index');
    
    Route::post('/orders/{order}', 'LoadingController@getOrderState');

});
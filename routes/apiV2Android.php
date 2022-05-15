<?php

use App\Http\Middleware\LoadingAuthentication;
use Illuminate\Support\Facades\Route;

Route::namespace('Api\V2Android')->group(function () {

    Route::post('/loading', 'LoadingController@index');
    
    Route::post("/upload", "LoadingController@upload");
    
    Route::post("/requestCode", "LoadingController@requestCode");

});
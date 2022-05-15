<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post("/checkVersion","ApiController@check");
Route::post("/forgetPassword","ApiController@forgetpass");
Route::post("/sendForgetVerificationCode","ApiController@sendForgetVerificationCode");
Route::post("/setForgetPassword","ApiController@setForgetPassword");
Route::post("/changeInfo","ApiController@changeInfo");
Route::post("/signIn","ApiController@signIn");
Route::post("/SignUp","ApiController@SignUp");
Route::post("/sendVerificationCode","ApiController@sendVerificationCode");
Route::post("/requestCode","ApiController@requestCode");
Route::post("/buyHistory","ApiController@buyHistory");
Route::post("/upload","ApiController@upload");
Route::post("/setPassword","ApiController@setPassword");
Route::post("/sendBuyVerificationCode","ApiController@sendBuyVerificationCode");
Route::post("/responsemobile","payController@responsemobile");


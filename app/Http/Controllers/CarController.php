<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\plan;
use App\Models\usage;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    public function  create($insert="0")
    {
        $cars=car::all();
        return view("admin.groupList",compact(["cars","insert"]));
    }
    public function  createat()
    {
        return $this->create(1);
    }
    public function delete(Request $request)
    {
        plan::where("car_id",$request->id)->delete();
        usage::where("car_id",$request->id)->delete();
       car::find($request->id)->delete();

    }
    public function save(Request $request)
    {
        $car =new car();
        if($request->car_id!=0)
        {
            $car=car::find($request->car_id);
        }
        $car->name=$request->car_name;
        $car->save();
       return redirect("admin/car/save");
    }
}

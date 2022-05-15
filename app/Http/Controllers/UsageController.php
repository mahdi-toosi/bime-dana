<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\usage;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    //
    public function list()
    {
        $usages=usage::all();
        return view("admin.typeGroup",compact(["usages"]));
    }
    public function delete(Request $request)
    {
        usage::find($request->id)->delete();
    }
    public function create(Request $request)
    {
        $save=0;
        if($request->car_id){
        $u=new usage();
        $u->name=$request->typename;
        $u->car_id=$request->car_id;
        $u->percentage =str_replace(",","",$request->Increase);
        $u->type=$request->typeIncrease;
        $u->save();
        $save=1;
        }
        $cars=car::all();
        return view("admin.typeadd",compact(["cars","save"]));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Plan\UpdateRequest;
use App\Models\car;
use App\Models\plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function  list()
    {
        $plans = plan::all();
        return view("admin.tariffGroup", compact(["plans"]));
    }

    public function edit(plan $plan)
    {
        $cars = car::all();
        return view('admin.plans.edit', compact('plan', 'cars'));
    }

    public function update(plan $plan, UpdateRequest $request)
    {
        $plan->update([
            'name'              =>  $request->name,
            'car_id'            =>  $request->car_id,
            'base_price'        =>  $request->base_price,
            'driver_price'      =>  $request->driver_price,
            'daily_penalty'     =>  $request->daily_penalty,
        ]);
        return redirect()->route('plan.index')->with('success', 'گروه تعرفه ای با موفقیت ویرایش شد');
    }

    public function delete(Request $request)
    {
        plan::find($request->id)->delete();
    }

    public function create(Request $request)
    {
        $save = 0;
        if ($request->car_id) {
            $save = 1;
            $p = new plan();
            $p->car_id = $request->car_id;
            $p->name = $request->name;
            $p->base_price = str_replace(",", "", $request->base_price);
            $p->driver_price = str_replace(",", "", $request->driver_price);
            $p->daily_penalty = str_replace(",", "", $request->daily_penalty);
            $p->save();
            $save = 1;
        }

        $cars = car::all();
        return view("admin.tariffadd", compact(["cars", "save"]));
    }
}

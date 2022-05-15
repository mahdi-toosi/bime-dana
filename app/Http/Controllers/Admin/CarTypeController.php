<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarTypes\DefaultRequest;
use App\Http\Requests\Admin\CarTypes\StoreRequest;
use App\Models\car;
use App\Models\CarType;
use App\Models\plan;
use Illuminate\Session\Store;

class CarTypeController extends Controller
{
    public function create()
    {
        $cars = car::all();
        return view('admin.car-types.create', compact('cars'));
    }

    public function store(StoreRequest $request)
    {
        CarType::create([
            'title'     =>  $request->title,
            'car_id'    =>  $request->cars
        ]);
        return back()->with('success', 'نوع خودرو با موفقیت اضافه شد');
    }

    public function index()
    {
        $carTypes = CarType::all();
        return view('admin.car-types.index', compact('carTypes'));
    }

    public function destroy(CarType $carType)
    {
        $carType->delete();
        return back()->with('success', 'نوع خودرو با موفقیت حذف شد');
    }

    public function edit(CarType $carType)
    {
        $cars = car::all();
        return view('admin.car-types.edit', compact('carType', 'cars'));
    }

    public function update(CarType $carType, StoreRequest $request)
    {
        $carType->update([
            'title'     =>  $request->title,
            'car_id'    =>  $request->cars
        ]);
        return redirect()->route('admin.car-types.index')->with('success', 'نوع خودرو با موفقیت ویرایش شد');
    }

    public function updateStatus(CarType $carType)
    {
        $carType->update([
            'status'    =>  $carType->status == 1 ? 0 : 1
        ]);
        return redirect()->route('admin.car-types.index')->with('success', 'وضعیت با موفقیت ویرایش شد');
    }

    public function plans(CarType $carType)
    {
        return plan::where('car_id', $carType->car_id)->get();
    }

    public function default()
    {
        $carTypes = CarType::all();
        return view('admin.car-types.default', compact('carTypes'));
    }

    public function defaultUpdate(DefaultRequest $request)
    {
        CarType::default()->update([
            'default'    =>  CarType::INACTIVE
        ]);
        CarType::findOrFail($request->carType)->update([
            'default'    =>  CarType::ACTIVE
        ]);
        return back()->with('success', 'پیشفرض با موفقیت تغییر پیدا کرد.');
    }
}

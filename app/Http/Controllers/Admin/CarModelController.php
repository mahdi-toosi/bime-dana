<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarModels\DefaultRequest;
use App\Http\Requests\Admin\CarModels\StoreRequest;
use App\Http\Requests\Admin\CarModels\UpdateRequest;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\plan;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function create()
    {
        $carTypes = CarType::active()->get();
        $plans = plan::all();
        return view('admin.car-models.create', compact('carTypes', 'plans'));
    }

    public function store(StoreRequest $request)
    {
        CarModel::create([
            'title'         =>  $request->title,
            'car_type_id'   =>  $request->carType,
            'plan_id'       =>  $request->plans
        ]);
        return back()->with('success', 'مدل خودرو با موفقیت ثبت شد');
    }

    public function index()
    {
        $carModels = CarModel::all();
        return view('admin.car-models.index', compact('carModels'));
    }

    public function destroy(CarModel $carModel)
    {
        $carModel->delete();
        return back()->with('success', 'مدل خودرو با موفقیت حذف شد');
    }

    public function edit(CarModel $carModel)
    {
        $carTypes = CarType::active()->get();
        $plans = plan::where('car_id', $carModel->carType->car_id)->get();
        return view('admin.car-models.edit', compact('carModel', 'carTypes', 'plans'));
    }

    public function update(CarModel $carModel, UpdateRequest $request)
    {
        $carModel->update([
            'title'         =>  $request->title,
            'car_type_id'   =>  $request->carType,
            'plan_id'       =>  $request->plans
        ]);
        return redirect()->route('admin.car-models.index')->with('success', 'مدل خودرو با موفقیت ویرایش شد');
    }

    public function updateStatus(CarModel $carModel)
    {
        $carModel->update([
            'status'    =>  $carModel->status == 1 ? 0 : 1
        ]);
        return back()->with('success', 'وضعیت با موفقیت ویرایش شد');
    }

    public function default()
    {
        $carTypeDefault = CarType::default()->first();
        $carModels = CarModel::carTypes($carTypeDefault->id)->get();
        return view('admin.car-models.default', compact('carModels', 'carTypeDefault'));
    }

    public function defaultUpdate(DefaultRequest $request)
    {
        CarModel::default()->update([
            'default'   =>  CarModel::INACTIVE
        ]);
        CarModel::findOrFail($request->carModel)->update([
            'default'    =>  CarModel::ACTIVE
        ]);
        return back()->with('success', 'پیشفرض با موفقیت تغییر پیدا کرد.');
    }

}

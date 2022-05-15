<?php

namespace App\Http\Controllers;

use App\Models\commitment;
use App\Models\insurance;
use App\Models\plan;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    //
    public function list($insurance_id)
    {
        $insurance = insurance::find($insurance_id);
        $covers = commitment::where("insurance_id", $insurance_id)->get();

        return view("admin.coverGroup", compact(["covers", "insurance"]));
    }

    public function edit(commitment $commitment)
    {
        $plans = plan::all();
        return view('admin.covers.edit', compact('commitment', 'plans'));
    }

    public function update(commitment $commitment, Request $request)
    {
        $commitment->update([
            'plan_id'        =>  $request->plan_id,
            'insurance_id'   =>  $request->insurance,
            'cover_price'    =>  $request->cover_price,
            'price'          =>  str_replace(",", "", $request->price)
        ]);
        return redirect()->route('insurance.show', ['insurance_id' => $request->insurance])->with('success', 'ضریب پوشش با موفقیت ویرایش شد');
    }

    public function create($insurance_id, Request $request)
    {

        $save = 0;
        $insurance = insurance::find($insurance_id);
        $plans = plan::all();
        if ($request->insurance) {
            $c = new commitment();
            $c->plan_id = $request->plan_id;
            $c->insurance_id = $insurance_id;
            $c->cover_price = $request->cover_price;
            $c->price = str_replace(",", "", $request->price);
            $c->save();
            $save = 1;
        }
        return view("admin.coverAdd", compact(["save", "insurance", "plans"]));
    }

    public function delete(Request $request)
    {
        commitment::find($request->id)->delete();
    }
}

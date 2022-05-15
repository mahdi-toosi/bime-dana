<?php

namespace App\Http\Controllers;

use App\Models\insurance;
use App\Models\plan;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //
    public function edit($id){
        $save=0;
        $ins=insurance::find($id);
        return view("admin.insuranceAdd",compact(["save","ins"]));
    }
    public function create(Request $request){
        $save=0;
        $ins=new insurance();

        if($request->name){
            $i=new insurance();
            if($request->id!="")
            {
                $i=insurance::find($request->id);
            }
            $i->name=$request->name;
            if($request->customFile)
            {

                $name=date('YmdHis');
                //dd(public_path("/image/insurance"),$name.'.jpg');
                $path = $request->customFile->move("image/insurance",$name.'.jpg');
                $i->img="/image/insurance/".$name.".jpg";
            }
            $i->description=$request->description;
            $i->star=$request->star;
            $i->save();
            if($request->id!="")
            {
                return redirect("/admin/insurance/");
            }
            $save=1;
        }

        return view("admin.insuranceAdd",compact(["save","ins"]));
    }
    public function delete(Request $request){
        insurance::find($request->id)->delete();
    }
    public function list(){
        $insurances=insurance::all();
        return view("admin.insuranceList",compact(["insurances"]));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\insurance;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    //
    public function home()
    {
        return view("website.index");
    }
    public  function  profileadmin()
    {
        $save=0;
        return view("admin.profile",compact(["save"]));
    }
    public  function  profileuser()
    {
        $save=0;
        return view("website.profile",compact(["save"]));
    }
    public  function  myinsurance()
    {
        $orders=order::where("phone",\auth()->user()->phone)->get();
        return view("website.orders",compact(["orders"]));
    }
    public  function  edituser(Request $request)
    {
        $user=Auth::user();
        $user->name=$request->name;
        $user->address=$request->address;
        $user->save();
        $save=1;
        return view("website.profile",compact("save"));
    }
    public  function  changepassuser(Request $request)
    {
        $save = 0;
        if($request->pass==$request->reppass) {
            $user = Auth::user();
            $user->password = Hash::make($request->pass);
            $user->save();
            $save = 1;
        }
        return view("website.profile",compact(["save"]));
    }
    public  function  edit(Request $request)
    {
        $user=Auth::user();
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        $save=1;
        return view("admin.profile",compact("save"));
    }
    public  function  changepass(Request $request)
    {
        $save = 0;
        if($request->pass==$request->reppass) {
            $user = Auth::user();
            $user->password = Hash::make($request->pass);
            $user->save();
            $save = 1;
        }
        return view("admin.profile",compact(["save"]));
    }
    public  function  homeadmin()
    {
        $order_todey= order::where("created_at","like",date('Y-m-d')."%")->count();
        $order_count= order::all()->count();
        $user_count= User::all()->count();
        $income= Order::all()->sum( 'price' );
        return view("admin.index",compact(["order_todey","order_count","user_count","income"]));
    }
    public function about(){

        return view("website.aboutUs");
    }
    public function contact(){
        return view("website.contactUs");

    }
    public function terms(){
        return view("website.terms");
    }
    public function complaint(){
        return view("website.complaint");
    }
}

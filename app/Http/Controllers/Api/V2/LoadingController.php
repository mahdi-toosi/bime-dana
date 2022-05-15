<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\commitment;
use App\Models\insurance;
use App\Models\plan;
use App\Models\order;
use App\Models\usage;
use Illuminate\Http\Request;

class LoadingController extends Controller
{
    public function index(Request $request): array
    {
        return [
            'carType'       =>  car::all(),
            'plan'          =>  plan::all(),
            'commitment'    =>  commitment::all(),
            'insurance'     =>  insurance::all(),
            'usage'         =>  usage::all(),
            'carKinds'      =>  CarType::active()->get(),
            'carModels'     =>  CarModel::active()->get()
        ];
    }
    
    public function getOrderState(order $order)
    {
         return [
            'state' =>  $order->state,
            'id' =>  $order->id
        ];
    }
    
  
}

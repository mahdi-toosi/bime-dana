<?php

namespace App\Http\Controllers\Api\V2Android;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\commitment;
use App\Models\insurance;
use App\Models\plan;
use Carbon\Carbon;
use App\Models\order;
use App\Models\usage;
use Illuminate\Http\Request;

class LoadingController extends Controller
{
    
    function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
    
    public function index(Request $request): array
    {
        return [
            'newversion'    =>  5,
            'carType'       =>  car::all(),
            'plan'          =>  plan::all(),
            'commitment'    =>  commitment::all(),
            'insurance'     =>  insurance::all(),
            'usage'         =>  usage::all(),
            'carKinds'      =>  CarType::active()->get(),
            'carModels'     =>  CarModel::active()->get()
        ];
    }
    
    public function upload(Request $request)
    {
        // $order = order::findOrFail($request->order_id);
        $request->validate([
            'pic' => 'required|image|max:1024',
            // 'order_id' => 'required|exists:orders,id'
        ]);
        $f = $request->file('pic');
        $file = $f;
        $ex = $file->getClientOriginalExtension();
        $ex = trim($ex);
        $name = date('YmdHis') . rand(100, 999);
        $file->move("image/ws/", $name . '.jpg');
        // $order->update([]);
        return response()->json([
        'message' => 'تصویر با موفقیت ثبت شد',
        'url'     => "/image/ws/" . $name . ".jpg"
        ], 200);
    }
    
     public function requestCode(Request $request)
    {
        $request->validate([
            'codemeli' => 'required|digits:10|numeric',
            'price' => 'sometimes|numeric',
            'phone' => 'required|digits:11|numeric',
            'address' => 'required',
            'car_id' => 'required|exists:cars,id',
            'plan_id' => 'required|exists:plans,id',
            'usage_id' => 'required|exists:usages,id',
            'year' => 'required',
            'insurance_id' => 'required|exists:insurances,id',
            'payment_type' => 'required',
            'insurance_old_id' => 'required|exists:insurances,id',
            'insurance_old_type' => 'required',
            'cover' => 'required',
            'insurance_date_expire' => 'required'

        ]);
        $o = new order();
        $o->phone = $request->phone;
        $o->codemeli = $request->codemeli;
        $o->address = $request->address;
        $o->birthday = '1399-01-01';//$request->birthday;
        $o->car_id = $request->car_id;
        $o->plan_id = $request->plan_id;
        $o->usage_id = $request->usage_id;
        $o->year = $request->year;
        $o->insurance_id = $request->insurance_id;
        $o->payment_type = $request->payment_type;
        $o->insurance_old_id = $request->insurance_old_id;
        if ($request->insurance_old_id != -1 && $request->insurance_old_id != 0) {
            $o->insurance_old_id = $request->insurance_old_id;

        }

        $o->insurance_old_type = $request->insurance_old_type;
        $o->insurance_old_date = '';
        if ($request->insurance_old_date && $request->insurance_old_date != null)
            $o->insurance_old_date = $request->insurance_old_date;
        $o->insurance_old_off_percentage_third = $request->insurance_old_off_percentage_third;
        $o->insurance_old_off_percentage_driver = $request->insurance_old_off_percentage_driver;
        $o->insurance_old_property_damage = 0;
        $o->insurance_old_life_damage = 0;
        if ($o->insurance_old_property_damage) {
            $o->insurance_old_property_damage = $request->insurance_old_property_damage;
        }

        if ($o->insurance_old_life_damage) {
            $o->insurance_old_life_damage = $request->insurance_old_life_damage;
        }

        $o->cover = $request->cover;
        $o->insurance_date_expire = $request->insurance_date_expire;

        $o->image_front_card = "";
        if ($o->image_front_card) {
            $o->image_front_card = $request->image_front_card;
        }

        $o->image_back_card = "";
        if ($o->image_back_card) {
            $o->image_back_card = $request->image_back_card;
        }

        $o->image_personal_card = "";
        if ($o->image_personal_card) {
            $o->image_personal_card = $request->image_personal_card;
        }

        $o->image_insurance_card = "";
        if ($o->image_insurance_card) {
            $o->image_insurance_card = $request->image_insurance_card;
        }

        $now = Carbon::now();
        $dp = 0;
        
        if ($o->insurance_old_date != '') {
            
            $date = $this->convert($o->insurance_old_date);
            $jDate = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/n/j', $date);
            $jDate = Carbon::parse($jDate);

            // $jDate = Jalalian::fromFormat('Y-m-d', $date)->toCarbon()->format('Y-m-d');
            // dd($jDate);
        
            $dp = $now->diffInDays($jDate);
        }
        if ($dp < 0) {
            $dp = 0;
        }
        
        if ($request->payment_type == 0) {
            $o->price = $request->price ?: $this->getprice($o, $dp);
            $o->activation_code = rand(1000, 9999);
            $o->state = 0;
            $o->save();
            $code = $o->activation_code;
            $phone = $o->phone;
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($handle);
            return ["result" => true, "factorNum" => $o->id];
        }
        
        return ['error'];
        

    }
    
    
}

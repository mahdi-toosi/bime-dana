<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\order;
use App\Models\User;
use App\Models\commitment;
use App\Models\insurance;
use App\Models\plan;
use App\Models\usage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;

class ApiController extends Controller
{
    function convert($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
    
    //
    public function check(Request $request){
        $res=[];
        $res["newversion"]=5;
        if($request->version<$res["newversion"]){
       $res["carType"]=car::all();
       $res["plan"]=plan::all();
       $res["commitment"]=commitment::all();
       $res["insurance"]=insurance::all();
       $res["usage"]=usage::all();
        }
        if($request->userId)
        {
             $u=User::where("id",$request->userId)->where("token",$request->token)->count();
             if($u==0){
              $res["login"]=false;
             }
             else
             {
              $res["login"]=true;
              $res["name"]=  $u=User::where("id",$request->userId)->where("token",$request->token)->first()->name;
              
              $res["phone"]=  $u=User::where("id",$request->userId)->where("token",$request->token)->first()->phone;
              
             $res["address"]=  $u=User::where("id",$request->userId)->where("token",$request->token)->first()->address;
             }
        }
        return $res;
        
    }
    
      public  function  setPassword(Request $request)
    {
         $u=User::where("phone",$request->phone)->first();
         $u->password = Hash::make($request->password);
         $u->save();
          return ['result'=>true];
    }
    
        public  function  forgetpass(Request $request)
    {
        $code=rand(1000,9999);
        $phone=$request->phone;
        $u=User::where("phone",$request->phone)->count();
        if($u==0)
            return ['result'=>false];
        $u=User::where("phone",$request->phone)->first();
        $u->vc=$code;
        $u->save();
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handle);
        $json_response = json_decode($response);
        $result = $json_response->entries;

   /*     if ($result[0]->status) {

             return ['result'=>true];
        } else {
             return ['result'=>false];
        }
        */
        return ['result'=>true];
    }
    
    public  function  sendForgetVerificationCode(Request $request)
    {
        $u=User::where("phone",$request->phone)->where("vc",$request->code)->count();
        if($u==0)
            return ["result"=>false];
        $u=User::where("phone",$request->phone)->where("vc",$request->code)->first();
        $u->active=1;
        $token=Hash::make($u->id.$u->phone);
        $u->token=$token;
        $u->save();

        return ["result"=>true,"userId"=>$u->id,"token"=>$token];

    }
    
    public function upload(Request $request)
    {
        $f=$request->file('pic');
        if($f!=null) {
            $file = $f;
            $ex = $file->getClientOriginalExtension();
            $ex = trim($ex);
            if (in_array($ex, ["jpg", "png", "jpeg"])) {
                $name=date('YmdHis').rand(100,999);
                $file->move("image/ws/",$name.'.jpg');
                return "/image/ws/".$name.".jpg";
            }
        }


    }
    
    public  function  setForgetPassword(Request $request)
    {
        $u=User::where("phone",$request->phone)->where("token",$request->token)->count();
        if($u==0)
            return ["result"=>false];
        $u=User::where("phone",$request->phone)->where("token",$request->token)->first();
        $u->password = Hash::make($request->password);;
        $u->save();
        return ["result"=>true, "name"=>$u->name, "address"=>$u->address];
    }
    
    public  function  changeInfo(Request $request)
    {
        $u=User::where("phone",$request->phone)->where("token",$request->token)->count();
        if($u==0)
            return ["result"=>false];
        $u=User::where("phone",$request->phone)->where("token",$request->token)->first();
        if(!is_null($request->password)){
            $u->password=Hash::make($request->password);
        }
        
        $u->name=$request->name;
        $u->address=$request->address;
        $u->save();
        return ["result"=>true];
    }
    
    public  function  signIn(Request $request)
    {
        $u=User::where("phone",$request->phone)->count();
        if($u==0){
            $u=User::where("phone",$request->phone)->count();
            if($u==0)
            return ["result"=>false,"state"=>1];
            else
            return ["result"=>false,"state"=>0];
        }
        $u=User::where("phone",$request->phone)->first();
        if(Hash::check($request->password, $u->password)){
        $token=Hash::make($u->id.$u->phone);
        $u->token=$token;
        $u->save();
        return ["result"=>true,"token"=>$u->token,"userId"=>$u->id, "name"=>$u->name, "address"=>$u->address];
        }else{
            return ["result"=>false,"state"=>0];
        }
    }
    public function  getprice($o,$dp)
     {
         $year=Jalalian::now()->format("Y");
         $iid=$o->insurance_id;
         $cover=$o->cover;
         $make_year=$year-$o->year;
         $usage=$o->usage_id;
         $plan=$o->plan_id;
         $insurance_old=$o->insurance_old_id;
         $insurance_old_type=$o->insurance_old_type;
         $type=$o->insurance_date_expire;
         $off_car =$o->insurance_old_off_percentage_third;
         $off_driver =$o->insurance_old_off_percentage_driver;
         $danger_user = 0;
             $danger_driver = 0;
         if($o->insurance_old_property_damage) {
             $danger_driver = $o->insurance_old_property_damage; //$_POST['select11'];
         }
         if($o->insurance_old_life_damage){
             $danger_user = $o->insurance_old_life_damage; //$_POST['select10'];
         }
                      

         if($danger_user>0)
         {
             $danger_driver=0;
         }
         $danger=$danger_driver+$danger_user;
         $usage=usage::find($usage);
         $plan=plan::find($plan);

         $base=$plan->base_price;

         $driver=$plan->driver_price;
         $penalty=$plan->daily_penalty*$dp;

         $z_base=100;

         $z_driver=100;
         $z_penalty=100;
         if($make_year>15)
         {
             $z=20;
             if($make_year<25)
             {
                 $z=($make_year-15)*2;
             }
             $z_base+=$z;
             $z_driver+=$z;
             $z_penalty+=$z;
         }
         if($danger>0)
         {
             $z_base+=$danger;
             //jarime nadare driver
             $z_penalty+=$danger;
         }


         if($insurance_old_type==0  && $danger==0)
         {
             $off_car+=5;
             $off_driver+=5;
         }


         $z_base-=$off_car;
         $z_penalty-=$off_car;
         $z_driver-=$off_driver;
         if($usage->type==1)
         {
             $z_base-=$usage->percentage;
             $z_driver-=$usage->percentage;
         }

         if($z_base>0)
             $base=$base*$z_base/100;
         if($z_driver>0)
             $driver=$driver*$z_driver/100;
         if($z_penalty>0)
             $penalty=$penalty*$z_penalty/100;

         if($type==2)
         {
             $base=$base*.6;
             $driver=$driver*.6;
         }
         else if($type==3)
         {
             $base=$base*.3;
             $driver=$driver*.3;
         }
         else if($type==4)
         {
             $base=$base*.15;
             $driver=$driver*.15;
         }

         $base=$base*109/100;
         $driver=$driver*109/100;

         $price=$base+$driver+$penalty;
         if($insurance_old==-1)
         {
            //$off_car-=100;
             $price+=$plan->base_price;
         }
         $covers=commitment::where("insurance_id",$iid)->orderBy('cover_price', 'asc')->get();
         $ps=$cover;
         if(count($covers)==0)
             return 0;
         $np=0;
         $ps-=11;
         $mps=$ps;
         foreach ($covers as $cover)
         {

             if($ps>0) {
                 if ($mps > $cover->cover_price - 11)
                     $y = $cover->cover_price - 11-($mps-$ps);
                 else
                     $y = $ps;
                 $ps = $ps-$y;
                 $np += $y * $cover->price;
             }
         }
         $price+=$np;
         return $price;
     }
     public function requestCode(Request $request){
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
         $o=new order();
         $o->phone=$request->phone;
         $o->codemeli=$request->codemeli;
         $o->address=$request->address;
         $o->birthday='1399-01-01';//$request->birthday;
         $o->car_id=$request->car_id;
         $o->plan_id=$request->plan_id;
         $o->usage_id=$request->usage_id;
         $o->year=$request->year;
         $o->insurance_id=$request->insurance_id;
         $o->payment_type=$request->payment_type;
         $o->insurance_old_id = $request->insurance_old_id;
         if($request->insurance_old_id != -1 && $request->insurance_old_id != 0){$o->insurance_old_id=$request->insurance_old_id;
             
         }
         
         $o->insurance_old_type=$request->insurance_old_type;
         $o->insurance_old_date='';
         if($request->insurance_old_date && $request->insurance_old_date!=null)
             $o->insurance_old_date=$request->insurance_old_date;
         $o->insurance_old_off_percentage_third=$request->insurance_old_off_percentage_third;
         $o->insurance_old_off_percentage_driver=$request->insurance_old_off_percentage_driver;
         $o->insurance_old_property_damage=0;
         $o->insurance_old_life_damage=0;
         if($o->insurance_old_property_damage){
             $o->insurance_old_property_damage=$request->insurance_old_property_damage;
         }
         
         if($o->insurance_old_life_damage){
             $o->insurance_old_life_damage=$request->insurance_old_life_damage;
         }
         
         $o->cover=$request->cover;
         $o->insurance_date_expire=$request->insurance_date_expire;
        
        $o->image_front_card="";
        if($o->image_front_card){
            $o->image_front_card=$request->image_front_card;
        }
        
        $o->image_back_card="";
        if($o->image_back_card){
            $o->image_back_card=$request->image_back_card;
        }
         
         $o->image_personal_card="";
         if($o->image_personal_card){
             $o->image_personal_card=$request->image_personal_card;
         }
         
         $o->image_insurance_card="";
         if($o->image_insurance_card){
             $o->image_insurance_card=$request->image_insurance_card;
         }
         
         $now = date('Y-m-d');
         $dp=0;
         if($o->insurance_old_date!='') {
             $date = $this->convert($o->insurance_old_date);

             $jDate = Jalalian::fromFormat('Y-m-d', $date)->toCarbon()->format('Y-m-d');
             $date1 = date_create($now);
             $date2 = date_create($jDate);
             $diff = date_diff($date1, $date2);
             $dp = $diff->days;
         }
        if($dp<0)
        {
            $dp=0;
        }
        if($request->payment_type==0){
         $o->price=$request->price;
         $o->activation_code=rand(1000,9999);
         $o->state=0;
         $o->save();
         $code=$o->activation_code;
         $phone=$o->phone;
         $handle = curl_init();
         curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
         curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
         curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
          curl_exec($handle);
        }
           return ["result"=>true,"factorNum"=>$o->id];

     }
      public  function  buyHistory(Request $request)
      {
         
         $u=User::where("phone",$request->phone)->where("token",$request->token)->count();
          if($u==0)
              return ["result"=>false];
          $u=User::where("phone",$request->phone)->where("token",$request->token)->first();
         $orders= order::innerjoin("insurances","insurances.id","orders.insurance_id")->where("orders.phone",$request->phone)
             ->select(["orders.name","insurances.insurance_date_expire","orders.price","orders.created_at","orders.state"])->get();
            $res=[];
            foreach ($orders as $order)
          {
                $x="یکساله ";
                if($order->insurance_date_expire==2)
                {
                    $x=" شش ماهه";
                }
              if($order->insurance_date_expire==3)
              {
                  $x=" سه ماهه";
              }
              if($order->insurance_date_expire==4)
              {
                  $x=" یک ماهه";
              }
              $res[]=["money"=>$order->price,"state"=>$orders->state,"type"=>"شخص ثالث ".$x,"name"=>$order->name,"date"=>Jalalian::fromCarbon(Carbon::parse($order->created_at))->format('Y-m-d')];
          }

          return ["result"=>true,"data"=>$res];
      }
    public  function  SignUp(Request $request)
    {
        $u=User::where("phone",$request->phone)->count();
        if($u>0)
            return ["result"=>false];
        $u=new User();
        $u->name=$request->name;
        $u->phone=$request->phone;
        $u->address=$request->address;
        $u->password=Hash::make($request->password);
        $u->active=0;
        $u->vc=rand(1000,9999);
        $u->save();
        $code=$u->vc;
        $phone=$u->phone;
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handle);
        $json_response = json_decode($response);
        $result = $json_response->entries;
        return ["result"=>true];
    }
    
    /*
    public  function  setPassword(Request $request)
    {
        $u=User::where("phone",$request->phone)->where("token",$request->token)->count();
        if($u==0)
            return ["result"=>false];
        $u=User::where("phone",$request->phone)->where("token",$request->token)->first();
        $u->password=$request->password;
        $u->save();
        return ["result"=>true,"userId"=>$u->id];
    }
    
    */
    
    public  function  sendBuyVerificationCode(Request $request)
    {
        file_put_contents("x.txt",$request->code);
        $o=order::find($request->factorNum);
        file_put_contents("x.txt",$o->activation_code.':'.$request->code);
        if($o->activation_code==$request->code){
            
            $o->state=1;
            $o->save();
            return ["result"=>true];
        }
        return ["result"=>false];
       
    }
    
    public  function  sendVerificationCode(Request $request)
    {
        
        $u=User::where("phone",$request->phone)->where("vc",$request->code)->count();
        if($u==0)
            return ["result"=>false];
        $u=User::where("phone",$request->phone)->where("vc",$request->code)->first();
        $u->active=1;
        $token=Hash::make($u->id.$u->phone);
        $u->token=$token;
        $u->save();
        return ["result"=>true,"token"=>$u->token];
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\commitment;
use App\Models\insurance;
use App\Models\plan;
use App\Models\order;
use App\Models\usage;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;

class OrderController extends Controller
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
    public function create(){
       $cars=car::where("name","!=","موتورسیکلت")->get()->toArray();
        $i=0;
       foreach ($cars as $car)
       {
           $cars[$car["id"]]["plan"]=plan::where("car_id",$car["id"])->get()->toArray();
           $cars[$car["id"]]["usage"]=usage::where("car_id",$car["id"])->get()->toArray();
           $i++;
       }
       $data=json_encode($cars);
       $year=Jalalian::now()->format("Y");
       $month=Jalalian::now()->format("m");
       $day=Jalalian::now()->format("j");
        $insurances=insurance::orderBy("star","DESC")->get();
        $today=Jalalian::now()->format("Y/m/d");
        return View("website.buy",compact(["data","year","month","day","insurances","today"]));
    }
    public function createmotorcycle(){
        $cars=car::where("name","موتورسیکلت")->get()->toArray();
        $i=0;
        foreach ($cars as $car)
        {
            $cars[$car["id"]]["plan"]=plan::where("car_id",$car["id"])->get()->toArray();
            $cars[$car["id"]]["usage"]=usage::where("car_id",$car["id"])->get()->toArray();
            $i++;
        }
        $data=json_encode($cars);
        $year=Jalalian::now()->format("Y");
        $month=Jalalian::now()->format("m");
        $day=Jalalian::now()->format("j");
        $insurances=insurance::orderBy("star","DESC")->get();
        $today=Jalalian::now()->format("Y/m/d");
        return View("website.buy",compact(["data","year","month","day","insurances","today"]));
    }
    public function  savefile($f)
    {
        if($f!=null) {
            $file = $f;
            $ex = $file->getClientOriginalExtension();
            $ex = trim($ex);
            if (in_array($ex, ["jpg", "png", "jpeg"])) {
                $name=date('YmdHis').rand(100,999);
                $file->move("image/",$name.'.jpg');
                return "/image/".$name.".jpg";
            }
        }
        return '';
    }
     public function save(Request $request){
          $request->validate([
             'phone' => 'required|size:11',
             'codemeli' => 'required|size:10',
             'image_front_card' => 'required|File|image',
             'image_personal_card' => 'required|File|image',
         ]);
         $o=new order();
         $o->phone=$request->phone;
         $o->payment_type=$request->payment_type;
         $o->codemeli=$request->codemeli;
         $o->address=$request->address;
         $o->birthday=$request->birthday;
         $o->car_id=$request->car_id;
         $o->plan_id=$request->plan_id;
         $o->usage_id=$request->usage_id;
         $o->year=$request->year;
         $o->insurance_id=$request->insurance_id;
         $o->payment_type=$request->payment_type;
         $o->insurance_old_id=$request->insurance_old_id;
         $o->insurance_old_type=$request->insurance_old_type;
         $o->insurance_old_date='';
         if($request->insurance_old_date && $request->insurance_old_date!=null)
             $o->insurance_old_date=$request->insurance_old_date;
         $o->insurance_old_off_percentage_third=$request->insurance_old_off_percentage_third;
         $o->insurance_old_off_percentage_driver=$request->insurance_old_off_percentage_driver;
         $o->insurance_old_property_damage=$request->insurance_old_property_damage;
         $o->insurance_old_life_damage=$request->insurance_old_life_damage;
         $o->cover=$request->cover;
         $o->insurance_date_expire=$request->insurance_date_expire;

         $o->image_front_card=$this->savefile($request->file('image_front_card'));
         $o->image_back_card=$this->savefile($request->file('image_back_card'));;
         $o->image_personal_card=$this->savefile($request->file('image_personal_card'));
         $o->image_insurance_card=$this->savefile($request->file('image_insurance_card'));
         $now = date('Y-m-d');
         $dp=0;
         if($o->insurance_old_date!='') {
             $date = $this->convert($o->insurance_old_date);

             $jDate = Jalalian::fromFormat('Y/m/d', $date)->toCarbon()->format('Y-m-d');
             $date1 = date_create($now);
             $date2 = date_create($jDate);
             $diff = date_diff($date1, $date2);
             $dp = $diff->days;
         }
        if($dp<0)
        {
            $dp=0;
        }
         $o->price=$this->getprice($o,$dp);
         $o->activation_code=rand(1000,9999);
         $o->state=0;
         $o->save();
         if($request->payment_type==0){
         session(['sendcode' => $o->activation_code]);
         session(['phone' => $o->phone]);
         session(['ID' => $o->id]);
         $code=$o->activation_code;
         $phone=$o->phone;
         $handle = curl_init();
         curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
         curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
         curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
          curl_exec($handle);
         }

     }
     public function resms()
     {
         $phone=session('phone', '');
         $code=session('sendcode', '');
         if($phone!="") {
             $handle = curl_init();
             curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
             curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
             curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
             curl_exec($handle);
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
         if($o->insurance_old_property_damage) {
             $danger_user = $o->insurance_old_life_damage; //$_POST['select10'];
             $danger_driver = $o->insurance_old_property_damage; //$_POST['select11'];
         }
         else
         {
             $danger_user=0;
             $danger_driver =0;
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
    public function getinsurance(Request $request){
        $year=Jalalian::now()->format("Y");
        $make_year=$year-$request->year;// $_POST['select4'];
        if($request->insurance_old_damage_life || $request->insurance_old_damage_driver) {
            $danger_user = $request->insurance_old_damage_life; //$_POST['select10'];
            $danger_driver = $request->insurance_old_damage_driver; //$_POST['select11'];
        }
        else
        {
            $danger_user=0;
            $danger_driver =0;
        }


        $off_car =$request->insurance_old_third;// $_POST['select7'];
        $off_driver =$request->insurance_old_driver;// $_POST['select8'];
        $type =$request->time_insurence;// $_POST['select12'];
        $now = date('Y-m-d');
        $dp=0;
        if($request->insurance_old_enddate) {
            $date = $this->convert($request->insurance_old_enddate);

            $jDate = Jalalian::fromFormat('Y/m/d', $date)->toCarbon()->format('Y-m-d');
            $date1 = date_create($now);
            $date2 = date_create($jDate);
            $diff = date_diff($date1, $date2);
            $dp = $diff->days;
        }
        if($dp<0)
        {
            $dp=0;
        }
        if($danger_user>0)
        {
            $danger_driver=0;
        }
        $danger=$danger_driver+$danger_user;

        $insurances= insurance::orderBy("star","desc")->get();
        $res=[];
        $t_base=0;
        $t_driver=0;

            $usage=usage::find($request->usage);
            $plan=plan::find($request->plan);

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


            if($request->insurance_old_type==0 && $danger==0)
            {
                $off_car+=5;
                $off_driver+=5;
            }
            if($request->insurance_old==0)
            {
               // $off_car-=100;

            }

            $z_base-=$off_car;
            $z_penalty-=$off_car;
            $z_driver-=$off_driver;
            if($usage->type==1)
            {

                $z_base-=$usage->percentage;
                $z_driver-=$usage->percentage;
            }
            else
            {
                $z_base=0;
                $z_driver=0;
                $base=$usage->percentage;
                $driver=0;
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
            $bx=$base;
            $bd=$driver;
            $af=($base+$driver)*109/100;
            $base=$base*109/100;
            $driver=$driver*109/100;

            $price=$base+$driver+$penalty;
        if($request->insurance_old==-1)
        {
            //$off_car-=100;
            $price+=$plan->base_price;
        }
        foreach ($insurances as $insurance)
        {
            $covers=commitment::where("insurance_id",$insurance->id)->orderBy('cover_price', 'asc')->get();
            $ps=$request->cover;
            if(count($covers)==0)
                continue;
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
            $pc=$price+$np;
            //$pc=$z_base;
            $res[]=["id"=>$insurance->id,"base"=>number_format($bx,0),"driver"=>number_format($bd,0),"cover"=>number_format($np,0),"af"=>number_format($af,0),"dp"=>$dp,"more"=>$insurance->description,"img"=>$insurance->img,"name"=>$insurance->name,"price"=>number_format($pc,0),"star"=>$insurance->star];

        }
        return $res;// json_encode($res);
    }
    public function valdiate()
    {
        $value = session('sendcode', '');
        if($value=="")
            return redirect("/order");
        $error="0";
        return View("website.validate",compact(["error"]));
    }
    public function valdiateform(Request $request)
    {
        $value = session('sendcode', '');
        $id = session('ID', '');

        if($value=="")
            return "/order";
        if($value==$request->code)
        {
            $o=order::find($id);
            $o->state=1;
            $o->save();
            $u=User::where("phone",$o->phone)->count();
            if($u==0)
            {
                $u=new User();
                $u->name='';
                $u->phone=$o->phone;
                $u->password=Hash::make($o->codemeli);
                $u->address=$o->address;
                $u->type=0;
                $u->save();


            }
            if($o->payment_type==1)
                return '/order/recall';
            return "/pay/".$o->id;//redirect("/pay/".$o->id);
        }
        $error="1";
        return "error";
    }
      public function  recall()
      {
           return View("website.recall");
      }
    public function  sendsms()
    {
        $code=1111;
        $phone="09150467702";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/69772B532F7933484A73573438394F6755754B55455159494B554B394F4E30637A7051414353733836546F3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=verification');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handle);
        $json_response = json_decode($response);
        $result = $json_response->entries;
        dd($response);
        if ($result[0]->status) {

            return 1;
        } else {
            return 0;
        }
    }

    public function list()
    {
       
        $list=order::where("state",2)->orderBy("id","desc")->get();
        $nolist=order::where("state","<",2)->orderBy("id","desc")->get();
        return View("admin.requestList",compact(["list","nolist"]));
    }
    public function searcharchive($cid='0',$pid='0',$dt1='0',$dt2='0')
    {
        $list=order::where("state",">",2);
        if($cid!="0")
        {
            $list=$list->where("codemeli","like","%".$cid.'%');
        }
        if($cid!="0")
        {
            $list=$list->where("phone","like","%".$pid.'%');
        }
        if($dt1!="0")
        {
            $ja=Jalalian::fromFormat('Y-m-d', $dt1)->toCarbon()->format('Y-m-d H:i:s');
            $list=$list->where("created_at",">=",$ja);
        }
        if($dt2!="0")
        {
            $ja=Jalalian::fromFormat('Y-m-d', $dt2)->toCarbon()->format('Y-m-d 23:59:59');

            $list=$list->where("created_at","<=",$ja);
        }
            $list=$list->orderBy("id","desc")->paginate(15);
        return View("admin.confirmList",compact(["list","cid","pid","dt1","dt2"]));
    }
    public function listarchive()
    {
       return $this->searcharchive();
    }
    public function show($id)
    {
        $order=order::findOrFail($id);
        return View("admin/requestDetails",compact(["order"]));
    }
    public function delete(Request $request)
    {
        $order=order::find($request->id);
        $order->state=5;
        $order->save();
    }
    public function confirm(Request $request)
    {
        $order=order::find($request->id);
        $order->order_num=$request->bime;
        if($order->state==2)
        $order->state=3;
        else
        $order->state=4;
        $order->save();
    }
}

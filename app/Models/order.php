<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    public function insurance()
    {
        return $this->belongsTo("App\Models\insurance");
    }
    public function insuranceold()
    {
        return $this->belongsTo("App\Models\insurance","insurance_old_id");
    }

    public function car()
    {
        return $this->belongsTo("App\Models\car");
    }
    public function plan()
    {
        return $this->belongsTo("App\Models\plan");
    }
    public function usage()
    {
        return $this->belongsTo("App\Models\usage");
    }
    public function date()
    {
        if($this->insurance_date_expire==1)
            return "یک ساله";
        if($this->insurance_date_expire==2)
            return "شش ماهه";
        if($this->insurance_date_expire==3)
            return "سه ماهه";
        if($this->insurance_date_expire==4)
            return "یک ماهه";

    }
    public function statusspan()
    {
        switch ($this->state)
        {
            case 0:{ return '<span class="text-dark">ثبت اولیه</span>'; break;}
            case 1:{ return '<span class="text-primary">تایید اس ام اس</span>'; break;}
            case 2:{ return '<span class="text-success">پرداخت شده</span>'; break;}
            case 3:{ return '<span class="text-success">تایید شده</span>'; break;}
            case 4:{ return '<span class="text-warning">تایید شده دستی</span>'; break;}
            case 5:{ return '<span class="text-danger">حذف شده</span>'; break;}
        }
    }
}

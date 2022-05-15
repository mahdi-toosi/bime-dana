<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    //region const
    const ACTIVE = 1;
    const INACTIVE = 0;

    //endregion

    //region configs

    protected $guarded = [];

    public $timestamps = false;
    //endregion

    //region relations
    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function plan()
    {
        return $this->belongsTo(plan::class);
    }
    //endregion

    //region scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function scopeCarTypes($query, $id)
    {
        return $query->where('car_type_id', $id);
    }

    public function scopeDefault($query)
    {
        return $query->where('default', self::ACTIVE);
    }
    //endregion

    /*protected $appends = array('plan');

    public function getPlanAttribute()
    {
        return plan::where('id', $this->plan_id)->first();
    }*/

}

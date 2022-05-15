<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;

    //region configs
    public $timestamps = false;

    protected $guarded = [];
    //endregion

    //region scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function scopeDefault($query)
    {
        return $query->where('default', self::ACTIVE);
    }
    //endregion

    //region relations
    public function car()
    {
        return $this->belongsTo(car::class);
    }
    //endregion
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commitment extends Model
{
    use HasFactory;
    public function plan()
    {
        return $this->belongsTo("App\Models\plan");
    }

    public function insurance()
    {
        return $this->belongsTo(insurance::class);
    }

    protected $guarded = [];
}

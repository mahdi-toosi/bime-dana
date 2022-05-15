<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usage extends Model
{
    use HasFactory;
    public function car()
    {
        return $this->belongsTo("App\Models\car");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localisation extends Model
{
    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}

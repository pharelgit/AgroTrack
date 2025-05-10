<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statuts extends Model
{
    protected $table = 'statuts';

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }
}

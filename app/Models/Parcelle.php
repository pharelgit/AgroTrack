<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Parcelle extends Model
{
    protected $table = 'parcelles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statuts::class, 'statut_id');
    }
    
    public function localisation()
    {
        return $this->hasOne(Localisation::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
    

}

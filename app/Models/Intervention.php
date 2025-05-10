<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $table = 'interventions';

    protected $fillable = [
        'parcelle_id',
        'type_intervention_id',
        'date_debut',
        'date_fin',
        'description',
        'quantite_eau_utilisee',
        'quantite_engrais',
        'quantite_pesticide',
        'quantite_semences',
        'quantite_recolte',
        'user_id',
    ];

    /**
     * Relation avec la parcelle
     */
    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }

    /**
     * Relation avec le type d'intervention
     */
    public function typeIntervention()
    {
        return $this->belongsTo(TypeIntervention::class, 'type_intervention_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Active les timestamps
     */
    public $timestamps = true;
}

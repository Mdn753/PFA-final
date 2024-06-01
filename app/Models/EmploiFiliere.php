<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiFiliere extends Model
{
    use HasFactory;
    protected $table ='emploi_filiere';
    protected $fillable =[
        'filiere',
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'id_salle',
        'id_enseignant',
        'matiere',
    ];

    public $timestamps = false;

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }
}

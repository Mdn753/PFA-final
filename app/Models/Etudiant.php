<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $table ='etudiant';
    protected $fillable =[
        'name',
        'filiere',
        'email',
        'password'
    ];
    public $timestamps = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $table = 'enseignant';

    protected $fillable = [
        'name',
        'matiere',
        'email',
        'password',
    ];

    public $timestamps = false;
}

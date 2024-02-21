<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatEmployee extends Model
{
    protected $table = 'srtk_etat_employee';

    protected $fillable = [
        'etat',
        'user_id'
    ];
    public $timestamps = false;

    use HasFactory;
}

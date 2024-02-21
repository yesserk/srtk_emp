<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ligne_station extends Model
{
    protected $table = 'srtk_ligne_station';
    use HasFactory;
    protected $fillable = [
        'station',
        'ligne',
    ];

    public $timestamps = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligne extends Model
{
    protected $table = 'srtk_ligne';

    protected $fillable = [
        'ligne',
        'num_ligne',
    ];
    public $timestamps = false;

    use HasFactory;
    public function stations()
{
    return $this->belongsToMany(Station::class, 'srtk_ligne_station', 'ligne', 'station');
}




    
}

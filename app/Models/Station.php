<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $table = 'srtk_station';

    protected $fillable = [
        'num_station',
        'station',
    ];

    public $timestamps = false; // Disable timestamp management

    public function lignes()
    {
        return $this->belongsToMany(Ligne::class, 'srtk_ligne_station', 'station', 'ligne');
    }
    

    
}

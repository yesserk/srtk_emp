<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyageur extends Model
{
    protected $table = 'srtk_voyageur';

    protected $fillable = [
        'voyage_id',
        'nbre_voyageur',
    ];
    public $timestamps = false;

    use HasFactory;

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyage_id');
    }
    
}

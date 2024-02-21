<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $table = 'srtk_caisse';

    protected $fillable = [
        'date',
        'voyage_id',
        'montant',
    ];
    public $timestamps = false;

    use HasFactory;

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyage_id');
    }
    

}

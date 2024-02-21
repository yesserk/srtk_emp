<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Gare.php (Gare model)
class Gare extends Model
{
    use HasFactory;

    protected $table = 'srtk_gare';

    protected $fillable = [
        'gare',
        'user_id',
    ];

    public $timestamps = false; // Disable timestamp management

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'gare_id');
    }
}

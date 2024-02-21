<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'srtk_bus';
    protected $primaryKey = 'code_car'; // Specify the primary key

    protected $fillable = [
        'code_car',
        'immatriculation',
        'marque',
    ];

    public $timestamps = false; // Disable timestamp management

    // Add any relationships or additional methods here as needed
}

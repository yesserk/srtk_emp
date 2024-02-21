<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    protected $table = 'srtk_total'; // Replace 'your_table_name' with the actual table name

    protected $fillable = [
        'total_voyage',
        'total_reservation',
        'total_scolaire',
        'total_professionnel',
        'date_resume',
    ];

    public $timestamps = false; // Disable timestamp management
}

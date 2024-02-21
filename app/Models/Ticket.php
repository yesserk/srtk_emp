<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'srtk_ticket'; // Replace 'your_table_name' with the actual table name

    protected $fillable = [
        'genre',
        'prix',
        'personalise'
    ];

    public $timestamps = false; // Disable timestamp management
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'srtk_permission';

    protected $fillable = [
        'user_id',
        'users',
        'employee',
        'type_employee',
        'etat_employee',
        'gare',
        'bus',
        'ligne',
        'station',
        'voyage',
    ];

    public $timestamps = false; // Disable timestamp management
}

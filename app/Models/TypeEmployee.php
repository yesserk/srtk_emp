<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEmployee extends Model
{
    protected $table = 'srtk_type_employee';

    protected $fillable = [
        'type_employee',
    ];
    public $timestamps = false;

    use HasFactory;
}

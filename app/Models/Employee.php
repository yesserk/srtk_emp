<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'srtk_employees';

    protected $fillable = [
        'nom',
        'date_naissance',
        'phone',
        'cin',
        'matricule_employee',
        'type_id',
        'date_embauche',
        'user_id',
    ];

    public $timestamps = false; // Disable timestamp management
    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'receveur_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeEmployee::class, 'type_id');
    }
    // Add any relationships or additional methods here as needed
}

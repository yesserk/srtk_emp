<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;
    protected $table = 'srtk_employee_etat';

    protected $fillable = [
        'employee_id',
        'etat_id',
        'date_etat',
    ];
    public $timestamps = false;

    public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}
public function etat_emp()
{
    return $this->belongsTo(EtatEmployee::class, 'etat_id');
}

}

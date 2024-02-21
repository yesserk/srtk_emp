<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'srtk_reservation'; // Replace 'your_table_name' with the actual table name

    protected $fillable = [
        'client',
        'date_voyage',
        'station_debut',
        'station_fin',
        'type_payement',
        'montant_espece',
        'num_paiement',
        'montant_cheque',
        'num_cheque',
    ];

    public $timestamps = false; // Disable timestamp management
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketVoyage extends Model
{
    use HasFactory;
    protected $table = 'srtk_ticket_voyage'; 

    protected $fillable = [
        'ticket_id',
        'voyage_id',
        'nbre_ticket',
        'debut',
        'fin',
    ];
    

    public $timestamps = false; // Disable timestamp management
     public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}

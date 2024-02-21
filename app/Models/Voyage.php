<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;
    protected $table = 'srtk_voyage';

    protected $fillable = ['date_voyage', 'heur_depart', 'gare_id', 'ligne_id', 'bus_id', 'chauffeur_id', 'receveur_id', 'Commentaire'];


    public $timestamps = false; // Disable timestamp management

    // Voyage.php (Voyage model)
    public function ligne()
    {
        return $this->belongsTo(Ligne::class, 'ligne_id');
    }
    
    public function gare()
    {
        return $this->belongsTo(Gare::class, 'gare_id');
    }
    public function caisse()
{
    return $this->hasOne(Caisse::class);
}
public function voyageur()
{
    return $this->hasOne(Voyageur::class, 'voyage_id');
}
public function receveursWithoutMontant()
{
    return $this->belongsTo(User::class, 'receveur_id') // Assuming the User model is used for receveurs
                ->doesntHave('caisse');
}
public function receveur()
{
    return $this->belongsTo(Employee::class, 'receveur_id')->where('type_id', 4);
}

public function ticketVoyages()
{
    return $this->hasMany(TicketVoyage::class, 'voyage_id');
}


}

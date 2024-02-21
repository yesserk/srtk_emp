<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Bus;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::query();
        $search = $request->input('search');
    
        // Check if the search_reservation form is submitted
        if ($search) {
            // Perform the search and filter reservations by date_voyage
            $reservations->whereDate('date_voyage', $search);
        }
    
        $totalreservations = $reservations->count();
        $reservations = $reservations->simplePaginate(10);
    
        return view('reservation.reservation', compact('reservations', 'search', 'totalreservations'));
    }
    


    public function create()
    { 
        return view('reservation/reservation_form');
    }

    public function edit($id)
    { 
        $reservation = Reservation::find($id);
        return view('reservation\reservation_edit', compact('reservation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_voyage' => 'required|date',
            'client' => 'required',
           'type_payement' => 'required|in:1,2', // Assuming type_payement should be either 1 or 2
            'montant_espece' => $request->type_payement == 1 ? 'required' : '',
            'num_paiement' => $request->type_payement == 1 ? 'required' : '',
            'montant_cheque' => $request->type_payement == 2 ? 'required' : '',
            'num_cheque' => $request->type_payement == 2 ? 'required' : '',
            'banque' => $request->type_payement == 2 ? 'required' : '',
        ]);

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->date_voyage = $request->date_voyage;
        $reservation->client = $request->client;
        $reservation->station_debut = $request->station_debut;
        $reservation->station_fin = $request->station_fin;
        $reservation->type_payement = $request->type_payement;


        // Fill additional fields based on the payment type
        if ($request->type_payement == 1) {
            $reservation->montant_espece = $request->montant_espece;
            $reservation->num_paiement = $request->num_paiement;
        } elseif ($request->type_payement == 2) {
            $reservation->montant_cheque = $request->montant_cheque;
            $reservation->num_cheque = $request->num_cheque;
            $reservation->banque = $request->banque;
        }

        // Save the reservation
        $reservation->save();

        // Redirect or do anything else you need
        return redirect()->route('reservation')->with('success', 'تم اضافة الحجز');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'date_voyage' => 'required|date',
        'client' => 'required',
        'type_payement' => 'required|in:1,2', // Assuming type_payement should be either 1 or 2
        'montant_espece' => $request->type_payement == 1 ? 'required' : '',
        'num_paiement' => $request->type_payement == 1 ? 'required' : '',
        'montant_cheque' => $request->type_payement == 2 ? 'required' : '',
        'num_cheque' => $request->type_payement == 2 ? 'required' : '',
        'banque' => $request->type_payement == 2 ? 'required' : '',
    ]);

    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Update the reservation fields
    $reservation->date_voyage = $request->date_voyage;
    $reservation->client = $request->client;
    $reservation->station_debut = $request->station_debut;
    $reservation->station_fin = $request->station_fin;
    $reservation->type_payement = $request->type_payement;

    // Fill additional fields based on the payment type
    if ($request->type_payement == 1) {
        $reservation->montant_espece = $request->montant_espece;
        $reservation->num_paiement = $request->num_paiement;
        // If updating, you might want to clear the fields related to the other payment type
        $reservation->montant_cheque = null;
        $reservation->num_cheque = null;
        $reservation->banque = null;
    } elseif ($request->type_payement == 2) {
        $reservation->montant_cheque = $request->montant_cheque;
        $reservation->num_cheque = $request->num_cheque;
        $reservation->banque = $request->banque;
        // If updating, you might want to clear the fields related to the other payment type
        $reservation->montant_espece = null;
        $reservation->num_paiement = null;
    }

    // Save the updated reservation
    $reservation->save();

    // Redirect or do anything else you need
    return redirect()->route('reservation')->with('success', 'تم تحديث الحجز');
}

public function destroy($id)
    {
        $reservation = Reservation::find($id);
    
        if ($reservation) {
            $reservation->delete();
            return redirect()->route('reservation')->with('success', 'تم حذف الحجز');
        } else {
            return redirect()->route('reservation')->with('error', 'لم يتم حذف الحجز');
        }
    }

    
}

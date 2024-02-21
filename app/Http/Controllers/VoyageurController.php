<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketVoyage;
use App\Models\Ticket;

class VoyageurController extends Controller
{
   
public function create($voyage_id)
{
    $tickets_stand  = Ticket::where('personalise',0)->get(); 
    $tickets_chang = Ticket::where('personalise',1)->get();
    
    $ticket_voyages = TicketVoyage::where('voyage_id', $voyage_id)->get(); 
    //var_dump($ticket_voyages);exit;

    
    return view('voyageur/voyageur_form', compact('tickets_stand','voyage_id','ticket_voyages','tickets_chang'));
}
public function store_chang(Request $request)
{
    $validatedData = $request->validate([
        'ticket_id' => 'required',
        'voyage_id' => 'required',
        'nbre_ticket' => 'numeric',
    ]);

    

    $voyage_id = $request->input('voyage_id');

    $voyageur = TicketVoyage::create($validatedData);
    $voyageur->save();

   
   return redirect()->route('voyageur.create', $voyage_id)->with('success', 'تم إضافة العدد بنجاح');
}
public function store_stan(Request $request)
{
    $request->validate([
        'ticket_id' => 'required',
        'voyage_id' => 'required',
        'debut' => 'numeric',
        'fin' => 'numeric',
    ]);
    $voyage_id = $request->input('voyage_id');
 
    $voyageur = new TicketVoyage();
        $voyageur->ticket_id = $request->ticket_id;
        $voyageur->voyage_id = $request->voyage_id;
        $voyageur->debut = $request->debut;
        $voyageur->fin = $request->fin;
        $voyageur->nbre_ticket = $request->nbre_ticket;

        $voyageur->save();

    return redirect()->route('voyageur.create', $voyage_id)->with('success', 'تم إضافة العدد بنجاح');
}

public function edit_stand($id)
{
    $ticket_stand = TicketVoyage::where('id', $id)->first(); // Use first() instead of get()
    
    // Check if the ticket_stand is not null before proceeding
    if ($ticket_stand) {
        $tickets = Ticket::where('personalise', 0)->get();
        return view('voyageur.voyageur_stan_edit', compact('ticket_stand', 'tickets'));
    } else {
        // Handle the case where the ticket is not found
        return abort(404); // or any other appropriate action
    }
}
public function update_stand(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'ticket_id' => 'required',
        'voyage_id' => 'required',
        'debut' => 'numeric',
        'fin' => 'numeric',
    ]);
    $voyage_id = $request->input('voyage_id');
    $voyageur = TicketVoyage::find($id);

    $voyageur->ticket_id = $validatedData['ticket_id'];
    $voyageur->voyage_id = $validatedData['voyage_id'];
    $voyageur->debut = $validatedData['debut'];
    $voyageur->fin = $validatedData['fin'];
    $voyageur->nbre_ticket = $request->input('fin') - $request->input('debut');
    
    // Save the changes to the database
    $voyageur->save();

    return redirect()->route('voyageur.create', $voyage_id)->with('success', 'تم تعديل العدد');
}

public function edit_chang($id)
{
    $ticket_chang = TicketVoyage::where('id', $id)->first(); // Use first() instead of get()
    
    // Check if the ticket_stand is not null before proceeding
    if ($ticket_chang) {
        $tickets = Ticket::where('personalise', 1)->get();
        return view('voyageur.voyageur_chang_edit', compact('ticket_chang', 'tickets'));
    } else {
        // Handle the case where the ticket is not found
        return abort(404); // or any other appropriate action
    }
}
public function update_chang(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'ticket_id' => 'required',
        'voyage_id' => 'required',
        'nbre_ticket' => 'required|numeric',
    ]);
    $voyage_id = $request->input('voyage_id');
    $voyageur = TicketVoyage::find($id);

    $voyageur->ticket_id = $validatedData['ticket_id'];
    $voyageur->voyage_id = $validatedData['voyage_id'];
    $voyageur->nbre_ticket = $validatedData['nbre_ticket'];
    
    // Save the changes to the database
    $voyageur->save();

    return redirect()->route('voyageur.create', $voyage_id)->with('success', 'تم تعديل العدد');
}




public function destroy($idV)
{
    $voyageur = TicketVoyage::where('id', $idV)->firstOrFail();

    $voyageur->delete();
    return redirect()->route('voyageur.create', $voyageur->voyage_id)->with('success', 'تم حذف العدد بنجاح');
}
}

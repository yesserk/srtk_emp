<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();
        $tickets = Ticket::simplePaginate(10);
        $search='';

        return view('ticket/ticket', compact('tickets','totalTickets','search'));
    }
    
    public function create()
    {
        
        return view('ticket/ticket_form');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'genre' => 'required|string',
            'prix' => 'required|integer',
            'personalise' => 'required|integer',
        ]);
    
        $ticket = Ticket::create($validatedData);
        $ticket->save();
    
        return redirect()->route('ticket')->with('success', 'تم اضافة التذكرة');
    }


    
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('ticket/ticket_edit', compact('ticket'));
    }
    
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
    
        if ($ticket) {
            $validatedData = $request->validate([
                'genre' => 'required',

                'prix' => 'required',
                'personalise' => 'required',
                // Add validation for other fields
            ]);
    
            $ticket->update($validatedData);
    
            return redirect()->route('ticket')->with('success', 'تو تعديل التذكرة ');
        } else {
            return redirect()->route('ticket')->with('error', 'لم يتم تعديل التذكرة');
        }
    }
    
    public function destroy($id)
    {
        $ticket= Ticket::find($id);
    
        if ($ticket) {
            $ticket->delete();
            return redirect()->route('ticket')->with('success', 'تم حذف التذكرة');
        } else {
            return redirect()->route('ticket')->with('error', 'لم يتم حذف التذكرة');
        }
    }

    public function search_ticket(Request $request)
{
    $search = $request->input('search');

    $query = Ticket::query()
        ->where('genre', 'LIKE', "%$search%")
        ->orWhere('prix', 'LIKE', "%$search%");

    $totalTickets = $query->count(); // Get the total count of search results

    $tickets = $query->paginate(10); // Paginate the search results (10 results per page)

    return view('ticket/ticket', compact('tickets', 'totalTickets', 'search'));
}
}

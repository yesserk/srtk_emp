<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Gare;
use App\Models\Ligne;
use App\Models\Bus;
use App\Models\Employee;

class VoyageController extends Controller
{
    public function index(Request $request)
    {
        $gares = Gare::all();
        $lignes = Ligne::all();
        $dateSysteme = now()->toDateString(); // Get the current date in the format YYYY-MM-DD
        $query = Voyage::with(['ligne', 'ligne.stations', 'gare']); // Include the "gare" relationship
    
        if ($request->has('filter_date')) {
            
            $filterDate = $request->input('filter_date');
            if($filterDate!=''){
            $query->whereDate('date_voyage', $filterDate);
        }
        }
    
        if ($request->has('filter_gare')) {
            $filterGare = $request->input('filter_gare');
            if($filterGare!=''){
            $query->where('gare_id', $filterGare);
            }
        }
    
        $voyages = $query->get();
    
        return view('voyage.voyage', compact('voyages', 'lignes', 'gares'));
    }
    
    

    

public function create()
    {
        $lignes = Ligne::with('stations')->get();
        $gares = Gare::all();
        $Tbus = Bus::all();
        $chauffeurs = Employee::where('type_id', 2)
    ->whereNotIn('id', function ($query) {
        $query->select('employee_id')
        ->from('srtk_employee_etat')
        ->whereColumn('employee_id', 'srtk_employees.id')
        ->where('etat_id','!=', 7)
        ->where('date_etat','!=',date('Y-m-d'));
    })
    ->get();

    $receveurs = Employee::where('type_id', 4)
    ->whereNotIn('id', function ($query) {
        $query->select('employee_id')
            ->from('srtk_employee_etat')
            ->whereColumn('employee_id', 'srtk_employees.id')
            ->where('etat_id','!=', 7);
    })
    ->get();
       
        return view('voyage/voyage_form' , compact('lignes','gares','Tbus','chauffeurs','receveurs'));
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'date_voyage' => 'required|date|date_format:Y-m-d',
            'heur_depart' => 'required',
            'gare_id' => 'required',
            'ligne_id' => 'required',
            'bus_id' => 'required',
            'chauffeur_id' => 'required',
            'receveur_id' => 'required',
            'Commentaire'=>'required'
        ]);
       

        $voyage = new Voyage($validatedData);
        $voyage->user_id = auth()->user()->id; // Assign the user who added the employee
        $voyage->save();


    
        return redirect()->route('voyage')->with('success', 'تم إضافة الرحلة بنجاح');
    }
    

    


public function destroy($id)
{
    $voyage = Voyage::find($id);

    if ($voyage) {
        $voyage->delete();
        return redirect()->route('voyage')->with('success', 'تم حذف الرحلة ');
    } else {
        return redirect()->route('voyage')->with('error', 'لم يتم حذف الرحلة');
    }
}
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EtatEmployee;
use App\Models\Etat;
use App\Models\Employee;

class EtatController extends Controller
{
    public function index()
    {
        $totalEtat = Etat::count();
        $etats = Etat::simplePaginate(10);
        
        return view('etat/etat', compact('totalEtat' , 'etats'));
    }

    public function create()
    {
        $etats= EtatEmployee::all();
        $employees = Employee::all();
        return view('etat/etat_form', compact('etats' , 'employees'));
    }
    public function edit($id)
    {
        $etats = EtatEmployee::all();
        $employees = Employee::all();
        $etatEmployee = Etat::find($id); // Updated variable name
        return view('etat/etat_edit', compact('etatEmployee', 'employees', 'etats','id'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'employe' => 'required',
            'etat' => 'required',
            'date_etat' => 'required',
    ]);

        $etatEmployee = Etat::find($id);

        // Check if the record was found
        if (!$etatEmployee) {
            return redirect()->route('etat', $id)->with('error', 'لم يتم ايجاد الحالة');
        }

        $etatEmployee->employee_id = $validatedData['employe'];
        $etatEmployee->etat_id = $validatedData['etat'];
        $etatEmployee->date_etat = $validatedData['date_etat'];

        // Save the changes to the database
        $etatEmployee->save();

        return redirect()->route('etat')->with('success', 'تم تعديل الحالة');
    }


    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'employee_id' => 'required',
            'etat_id' => 'required',
            'date_etat' => 'required',
        ]);

        // Création d'un nouvel état d'employé
        Etat::create($request->all());

        return redirect()->route('etat')->with('success', 'تم اضافة حالة الموظف');
    }

    public function destroy($id)
    {
        $etat = Etat::find($id);
    
        if ($etat) {
            $etat->delete();
            return redirect()->route('etat')->with('success', 'تم حذف الحالة');
        } else {
            return redirect()->route('etat')->with('error', 'لم يتم حذف الحالة');
        }
    }

    public function search_etat(Request $request)
    {
        $search = $request->input('search');
    
        $query = Etat::query()
            ->where('date_etat', 'LIKE', "%$search");
    
        $totalEtat = $query->count(); // Get the total count of search results
    
        $etats = $query->simplePaginate(10); // Paginate the search results (10 results per page)
    
        return view('etat/etat', compact('etats', 'totalEtat','search'));
    }
}

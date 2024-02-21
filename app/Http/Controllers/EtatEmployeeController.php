<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\EtatEmployee;

class EtatEmployeeController extends Controller
{
    public function index()
    {

        $totalEtats = EtatEmployee::count();
        $etats = EtatEmployee::simplePaginate(10);

        return view('etat_employe/etat_employees', compact('etats','totalEtats'));
    }

    public function create()
    {
        return view('etat_employe/etat_employees_form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'etat' => 'required|string|max:255',
        ]);
    
        $validatedData['user_id'] = auth()->user()->id;
    
        EtatEmployee::create($validatedData);
    
        return redirect()->route('etat_employees')->with('success', 'تم إضافة الحالة.');
    }
    

    public function edit($id)
    {
        $etatEmployee = EtatEmployee::find($id); // Updated variable name
        return view('etat_employe/etat_employees_edit', compact('etatEmployee'));
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'etat' => 'required|string|max:255',
    ]);

    $etatEmployee = EtatEmployee::find($id);

    // Check if the record was found
    if (!$etatEmployee) {
        return redirect()->route('etat_employees', $id)->with('error', 'لم يتم ايجاد الحالة');
    }

    $etatEmployee->etat = $validatedData['etat'];
    
    // Save the changes to the database
    $etatEmployee->save();

    return redirect()->route('etat_employees')->with('success', 'تم تعديل الحالة');
}


    public function destroy($id)
    {
        $etat = EtatEmployee::find($id);
    
        if ($etat) {
            $etat->delete();
            return redirect()->route('etat_employees')->with('success', 'تم حذف الحالة ');
        } else {
            return redirect()->route('etat_employees')->with('error', 'لم يتم حذف الحالة');
        }
    }

    public function search_etat_employee(Request $request)
{
    $search = $request->input('search');

    $query = EtatEmployee::query()
        ->where('etat', 'LIKE', "%$search");

    $totalEtats = $query->count();

    $etats = $query->paginate(10);

    return view('etat_employe/etat_employees', compact('etats', 'totalEtats'));
}

}

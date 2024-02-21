<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeEmployee;

class TypeEmployeeController extends Controller
{
    public function index()
    {
        $totalTypes  = TypeEmployee::count();
        $types = TypeEmployee::simplePaginate(10);
        return view('type_employe/type_employees', compact('types','totalTypes'));
    }

    public function create()
    {
        return view('type_employe/type_employees_form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_employee' => 'required|string|max:255',
        ]);
    
        $type_employee = new TypeEmployee($validatedData);
        $type_employee->user_id = auth()->user()->id; // Assign the user who added the employee
        $type_employee->save();
    
        return redirect()->route('type_employees')->with('success', 'تم اضافة الوظيفة.');
    }
    


    // Action to edit a type employee
    public function edit($id)
    {
        $typeEmployee = TypeEmployee::find($id); // Updated variable name
        return view('type_employe/type_employees_edit', compact('typeEmployee'));
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'type_employee' => 'required|string|max:255',
    ]);

    // Find the TypeEmployee record by its ID
    $typeEmployee = TypeEmployee::find($id);

    // Check if the record was found
    if (!$typeEmployee) {
        return redirect()->route('type_employees', $id)->with('error', 'لم يتم ايجاد الوظيفة');
    }

    // Update the attributes of the TypeEmployee
    $typeEmployee->type_employee = $validatedData['type_employee'];
    
    // Save the changes to the database
    $typeEmployee->save();

    return redirect()->route('type_employees')->with('success', 'تم تعديل الوظيفة');
}


    // Action to delete a type employee
    public function destroy($id)
    {
        $types = TypeEmployee::find($id);
    
        if ($types) {
            $types->delete();
            return redirect()->route('type_employees')->with('success', 'تم حذف الوظيفة ');
        } else {
            return redirect()->route('type_employees')->with('error', 'لم يتم حذف الوظيفة');
        }
    }

    public function search_type_employee(Request $request)
    {
        $search = $request->input('search');
    
        $query = TypeEmployee::query()
            ->where('type_employee', 'LIKE', "%$search%");
    
        $totalTypes = $query->count(); // Obtenir le nombre total de résultats
    
        $types = $query->paginate(10); // Paginer les résultats (10 résultats par page)
    
        return view('type_employe/type_employees', compact('types', 'totalTypes'));
    }
    
}

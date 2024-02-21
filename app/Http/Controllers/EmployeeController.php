<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\TypeEmployee;


class EmployeeController extends Controller
{
   
    public function index()
    {
        $totalEmployees = Employee::count();
        $employees = Employee::with('type')->simplePaginate(10);
        
        return view('employes/employees', compact('employees' , 'totalEmployees'));
    }
    
    public function create()
    {
         $type_employees = TypeEmployee::all();
        return view('employes/employees_form', compact('type_employees'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'phone' => 'required',
            'cin' => 'required',
            'matricule_employee' => 'required',
            'type_id' => 'required',
            'date_embauche' => 'required|date',
            'user_id' => '',
            // Add validation for other fields
        ]);
    
        $employee = Employee::create($validatedData);
        $employee->user_id = auth()->user()->id; // Assign the user who added the employee
        $employee->save();
    
        return redirect()->route('employees')->with('success', 'تم تسجيل الموظف');
    }


    
    public function edit($id)
{
    $type_employees = TypeEmployee::all();
    $employee = Employee::find($id);
    return view('employes.employees_edit', compact('employee', 'type_employees'));
}

    
public function update(Request $request, $id)
{
    $employee = Employee::find($id);

    if ($employee) {
        // Validate the request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'phone' => 'required|integer',
            'cin' => 'required|integer',
            'matricule_employee' => 'required|integer',
            'type_id' => 'required|integer',
            'date_embauche' => 'required|date',
            // Add validation for other fields
        ]);

        // Update the employee data
        $employee->update($validatedData);

        return redirect()->route('employees')->with('success', 'تم تعديل الموظف');
    } else {
        return redirect()->route('employees')->with('error', 'لم يتم تعديل الموظف');
    }
}

    
    public function destroy($id)
    {
        $employee = Employee::find($id);
    
        if ($employee) {
            $employee->delete();
            return redirect()->route('employees')->with('success', 'تم حذف الموظف');
        } else {
            return redirect()->route('employees')->with('error', 'لم يتم حذف الموظف');
        }
    }

    public function search_employee(Request $request)
{
    $search = $request->input('search');

    $query = Employee::query()
        ->where('nom', 'LIKE', "%$search%")
        ->orWhere('cin', 'LIKE', "%$search%")
        ->orWhere('phone', 'LIKE', "%$search%")
        ->orWhere('matricule_employee', 'LIKE', "%$search%")
        ->orWhere('type_id', 'LIKE', "%$search%");

    $totalEmployees = $query->count(); // Obtenir le nombre total de résultats

    $employees = $query->paginate(10); // Paginer les résultats (10 résultats par page)

    return view('employes.employees', compact('employees', 'totalEmployees'));
}

}

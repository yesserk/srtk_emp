<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gare;

class GareController extends Controller
{
    public function index()
    {
        $totalGares = Gare::count();
        $gares = Gare::simplePaginate(10);

        return view('gare/gare', compact('gares','totalGares'));
    }
    
    public function create()
    {
        
        return view('gare/gare_form');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gare' => 'required|string',
        ]);
    
        $user = auth()->user();
        if ($user) {
            $gare = new Gare($validatedData);
            $gare->user_id = $user->id; // Assign the user who added the gare
            $gare->save();
            return redirect()->route('gare')->with('success', 'تم اضافة النيابة');
        } else {
            // Handle the case when the user is not authenticated
            return redirect()->route('login')->with('error', 'You must be logged in to add a "gare"');
        }
    }
    

    
    public function edit($id)
    {
        $gare = Gare::find($id);
        return view('gare/gare_edit', compact('gare'));
    }
    
    public function update(Request $request, $id)
    {
        $gare = Gare::find($id);
    
        if ($gare) {
            $validatedData = $request->validate([

                'gare' => 'required|string',
                // Add validation for other fields
            ]);
            $gare->user_id = auth()->user()->id;
            $gare->update($validatedData);
    
            return redirect()->route('gare')->with('success', 'تو تعديل النيابة ');
        } else {
            return redirect()->route('gare')->with('error', 'لم يتم تعديل النيابة');
        }
    }
    
    public function destroy($id)
    {
        $gare = Gare::find($id);
    
        if ($gare) {
            $gare->delete();
            return redirect()->route('gare')->with('success', 'تم حذف النيابة');
        } else {
            return redirect()->route('gare')->with('error', 'لم يتم حذف النيابة');
        }
    }

    public function search_gare(Request $request)
{
    $search = $request->input('search');

    $query = Gare::query()
        ->where('gare', 'LIKE', "%$search");

    $totalGares = $query->count(); // Get the total count of search results

    $gares = $query->paginate(10); // Paginate the search results (10 results per page)

    return view('gare/gare', compact('gares', 'totalGares'));
}

}

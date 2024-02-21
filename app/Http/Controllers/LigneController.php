<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ligne;
use App\Models\Station;
use App\Models\ligne_station;
class LigneController extends Controller
{
    public function index()
    {
        $totalLignes = Ligne::count();


        $lignes = Ligne::simplePaginate(10);

        return view('ligne/ligne', compact('lignes','totalLignes'));
    }
    
    public function create()
    {
        $stations = Station::all();
        return view('ligne/ligne_form', compact('stations'));
    }
    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'ligne' => 'required',
        'num_ligne' => 'required|integer',
    ]);

    $ligne = Ligne::create($validatedData);
    $ligne->user_id = auth()->user()->id; // Assign the user who added the line
    $ligne->save();
    $id=$ligne->id;
  

return redirect("/ligne/station_ligne/".$id);
}


    
public function edit($id)
{
    $ligne = Ligne::find($id);
    // You should retrieve the selected station IDs for the line here
    $selectedStationIds = $ligne->stations->pluck('id')->toArray();
    
    $stations = Station::all();
    
    return view('ligne/ligne_edit', compact('ligne', 'stations', 'selectedStationIds'));
}
    
public function update(Request $request, $id)
{
    $ligne = Ligne::find($id);

    if ($ligne) {
        $validatedData = $request->validate([
            'ligne' => 'required',
            'num_ligne' => 'required',
            // Add validation for other fields
        ]);

        $ligne->update($validatedData);

       

        return redirect()->route('ligne')->with('success', 'تم تحديث الخط بنجاح');
    } else {
        return redirect()->route('ligne')->with('error', 'لم يتم تحديث الخط');
    }
}

    
    public function destroy($id)
    {
        $ligne = Ligne::find($id);
    
        if ($ligne) {
            $ligne->delete();
            return redirect()->route('ligne')->with('success', 'تم حذف الحافلة');
        } else {
            return redirect()->route('ligne')->with('error', 'لم يتم حذف الحافلة');
        }
    }


    public function destroy_ligne_station($idl,$id_station)
    {
        
        $delete=ligne_station::where('ligne', $idl)->where('station', $id_station)->delete();


            return redirect("/ligne/station_ligne/".$idl);
      
    }

    // LigneController.php (votre contrôleur)

    public function ligne_station($id)
    {
        $lignesy = Ligne::find($id);
        $lignes = Ligne::all();
        $stations = Station::all();
        $station_ligne=0;
        return view('ligne/affecter_station', compact('stations', 'lignesy','lignes'));
    }
    
    public function addStation(Request $request, Ligne $ligne)
{

    $data=[

        'station'=>$request->input('station'),
        'ligne'=>$request->input('ligne'),
    ];
    ligne_station::create($data);

    // Check if any stations were selected
        return redirect("/ligne/station_ligne/".$ligne->id);
  
}
public function search_ligne(Request $request)
{
    $search = $request->input('search');

    $query = Ligne::query()
        ->where('ligne', 'LIKE', "%$search%")
        ->orWhere('num_ligne', 'LIKE', "%$search%");

    $totalLignes = $query->count(); // Get the total count of search results

    $lignes = $query->paginate(10); // Paginate the search results (10 results per page)

    return view('ligne/ligne', compact('lignes', 'totalLignes','search'));
}


}

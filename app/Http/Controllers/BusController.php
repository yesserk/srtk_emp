<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {

        $totalBus = Bus::count();
        
        $Tbus = Bus::simplePaginate(10);
        $search='';


        return view('bus/bus', compact('Tbus','search'));
    }
    
    public function create()
    {
        
        return view('bus/bus_form');
    }
    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code_car' => 'required|string|unique:srtk_bus,code_car',
            'immatriculation' => 'required|unique:srtk_bus,immatriculation',
            'marque' => 'required',
        ]);
    
        $bus = Bus::create($validatedData);
        $bus->user_id = auth()->user()->id;
        $bus->save();
    
        return redirect()->route('bus')->with('success', 'تم اضافة الحافلة');
    }


    
    public function edit($code_car)
    {
        $bus = Bus::find($code_car);
        return view('bus/bus_edit', compact('bus'));
    }
    
    public function update( $code_car,Request $request)
    {
        $bus = Bus::where('code_car',  $code_car)->first(); // Find the Bus by code_car
    
        if ($bus) {
            $validatedData = $request->validate([
                'marque' => 'required|max:255',
                // Add validation for other fields
            ]);
            Bus::where('code_car', $code_car)
            ->update(['marque'=>$request->input('marque')]);

            //$bus->update($validatedData);
  
           return redirect()->route('bus')->with('success', 'تم تعديل الحافلة');
        } else {
    return redirect()->route('bus')->with('error', 'لم يتم تعديل الحافلة');
        }
    }
    
    
    public function destroy($code_car)
    {
        $bus = Bus::find($code_car);
    
        if ($bus) {
            $bus->delete();
            return redirect()->route('bus')->with('success', 'تم حذف الحافلة');
        } else {
            return redirect()->route('bus')->with('error', 'لم يتم حذف الحافلة');
        }
    }

    public function search_bus(Request $request)
    {
        $search = $request->input('search');
    
        $query = Bus::query()
            ->where('code_car', 'LIKE', "%$search")
            ->orWhere('immatriculation', 'LIKE', "%$search")
            ->orWhere('marque', 'LIKE', "%$search");
    
        $totalBus = $query->count(); // Get the total count of search results
    
        $Tbus = $query->simplePaginate(10); // Paginate the search results (10 results per page)
    
        return view('bus/bus', compact('Tbus', 'totalBus','search'));
    }
    
}

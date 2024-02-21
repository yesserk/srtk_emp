<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    public function index()
    {
        $totalStations = Station::count();
        $stations = Station::simplePaginate(10);
        $search='';

        return view('station/station', compact('stations','totalStations','search'));
    }
    
    public function create()
    {
        
        return view('station/station_form');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'station' => 'required|string',
            'num_station' => 'required|integer|unique:srtk_station,num_station',
        ]);
    
        $station = Station::create($validatedData);
        $station->user_id = auth()->user()->id; // Assign the user who added the employee
        $station->save();
    
        return redirect()->route('station')->with('success', 'تم اضافة المحطة');
    }


    
    public function edit($id)
    {
        $station = Station::find($id);
        return view('station/station_edit', compact('station'));
    }
    
    public function update(Request $request, $id)
    {
        $station = Station::find($id);
    
        if ($station) {
            $validatedData = $request->validate([
                'num_station' => 'required|unique:srtk_station,num_station,' . $id,

                'station' => 'required|string',
                // Add validation for other fields
            ]);
    
            $station->update($validatedData);
    
            return redirect()->route('station')->with('success', 'تو تعديل المحطة ');
        } else {
            return redirect()->route('station')->with('error', 'لم يتم تعديل المحطة');
        }
    }
    
    public function destroy($id)
    {
        $station = Station::find($id);
    
        if ($station) {
            $station->delete();
            return redirect()->route('station')->with('success', 'تم حذف المحطة');
        } else {
            return redirect()->route('station')->with('error', 'لم يتم حذف المحطة');
        }
    }

    public function search_station(Request $request)
{
    $search = $request->input('search');

    $query = Station::query()
        ->where('station', 'LIKE', "%$search%")
        ->orWhere('num_station', 'LIKE', "%$search%");

    $totalStations = $query->count(); // Get the total count of search results

    $stations = $query->paginate(10); // Paginate the search results (10 results per page)

    return view('station/station', compact('stations', 'totalStations', 'search'));
}

}

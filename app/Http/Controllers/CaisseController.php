<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Caisse;
use Illuminate\Support\Facades\Auth;

class CaisseController extends Controller
{
    public function index($voyage_id)
    {
        $caisses = Caisse::where('voyage_id', $voyage_id)->get();
        return view('caisse.caisse', compact('caisses'));
    }
public function create($voyage_id)
{
    return view('caisse/caisse_form', compact('voyage_id'));
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'voyage_id' => 'required',
        'date' => 'required|date',
        'montant' => 'required|numeric',
    ]);

    $caisse = new Caisse($validatedData);
    $caisse->user_id = auth()->user()->id;
    $caisse->save();
$voyage_id=$request->route('voyage_id');
    return redirect()->route('voyage')
        ->with('success', 'تم إضافة المبلغ بنجاح');
}


public function destroy($idV)
{
    $caisse = Caisse::where('voyage_id', $idV)->firstOrFail();

    $caisse->montant = 0;
    $caisse->delete();
    return redirect()->route('voyage', ['voyage_id' => $caisse->voyage_id])->with('success', 'تم حذف المبلغ');
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Reservation;
use Carbon\Carbon;


use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $resultsVoyageurUrbain =Voyage::whereBetween('ligne_id', [2000, 5999])
        ->where('date_voyage', $today)
        ->get();
        //var_dump($resultsVoyageurUrbain);exit;
        $totalMontantU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurB =Voyage::whereBetween('ligne_id', [1000, 1999])
        ->where('date_voyage', $today)
        ->get();

        $totalMontantB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurEntreV =Voyage::where('ligne_id', 0)
        ->where('date_voyage', $today)
        ->get();

        $totalMontantV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });
$Totale=$totalMontantV+$totalMontantU+$totalMontantB;

$chequeT= Reservation::where('type_payement', 2)
->whereDate('date_voyage', date('Y-m-d'))
->sum('montant_cheque');
        
        $cashT = Reservation::where('type_payement', 1)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->sum('montant_espece');
            
            $chequeCount = Reservation::where('type_payement', 2)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->count();
            $cashCount = Reservation::where('type_payement', 1)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->count();

            //dd($chequeCount,$cashCount);
        return view('dashboard',compact('totalMontantU','totalMontantB','totalMontantV','Totale','chequeCount','cashCount','cashT','chequeT'));
    }

    public function filtrerParDate(Request $request){
    $filterOption = $request->input('filterOption');

    switch ($filterOption) {
        case 'today':
            $resultsUrbain = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantUrbain'))
            ->where('srtk_voyage.ligne_id', '>=', 2000)
            ->where('srtk_voyage.ligne_id', '<', 6000)
            ->where('srtk_voyage.date_voyage', date('Y-m-d'))
            ->first();
            $totalMontantUrbain = $resultsUrbain->totalMontantUrbain ?? 0;

        $resultsB = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantB'))
            ->where('srtk_voyage.ligne_id', '>=', 1000)
            ->where('srtk_voyage.ligne_id', '<', 2000)
            ->where('srtk_voyage.date_voyage', date('Y-m-d'))
            ->first();
            $totalMontantB = $resultsB->totalMontantB ?? 0;

            $resultsEntreV = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantEntreV'))
            ->where('srtk_voyage.ligne_id', '<', 1000)
            ->where('srtk_voyage.ligne_id', '<=', 6000)
            ->where('srtk_voyage.date_voyage', date('Y-m-d'))
            ->first();
            $totalMontantEntreV= $resultsEntreV->totalMontantEntreV ?? 0;
            $Totale = $totalMontantUrbain+ $totalMontantB + $totalMontantEntreV ;

            $chequeT= Reservation::where('type_payement', 2)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->sum('montant_cheque');

            
        
        $cashT = Reservation::where('type_payement', 1)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->sum('montant_espece');
            
            $chequeCount = Reservation::where('type_payement', 2)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->count();
            $cashCount = Reservation::where('type_payement', 1)
            ->whereDate('date_voyage', date('Y-m-d'))
            ->count();

            

            break;

        case 'ce_mois':
            $currentMonth = Carbon::now()->month;
            $resultsUrbain = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantUrbain'))
            ->where('srtk_voyage.ligne_id', '>=', 2000)
            ->where('srtk_voyage.ligne_id', '<', 6000)
            ->whereMonth('srtk_voyage.date_voyage', '=', $currentMonth)
            ->first();
            $totalMontantUrbain = $resultsUrbain->totalMontantUrbain ?? 0;

        $resultsB = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantB'))
            ->where('srtk_voyage.ligne_id', '>=', 1000)
            ->where('srtk_voyage.ligne_id', '<', 2000)
            ->whereMonth('srtk_voyage.date_voyage', '=', $currentMonth)
            ->first();
            $totalMontantB = $resultsB->totalMontantB ?? 0;

            $resultsEntreV = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantEntreV'))
            ->where('srtk_voyage.ligne_id', '<', 1000)
            ->where('srtk_voyage.ligne_id', '<=', 6000)
            ->whereMonth('srtk_voyage.date_voyage', '=', $currentMonth)
            ->first();
            $totalMontantEntreV= $resultsEntreV->totalMontantEntreV ?? 0;
            $Totale = $totalMontantUrbain+ $totalMontantB + $totalMontantEntreV ;



            $chequeT= Reservation::where('type_payement', 2)
            ->whereMonth('date_voyage', '=', $currentMonth)
            ->sum('montant_cheque');

        $cashT = Reservation::where('type_payement', 1)
        ->whereMonth('date_voyage', '=', $currentMonth)
        ->sum('montant_espece');
            
            $chequeCount = Reservation::where('type_payement', 2)
            ->whereMonth('date_voyage', '=', $currentMonth)
            ->count();
            $cashCount = Reservation::where('type_payement', 1)
            ->whereMonth('date_voyage', '=', $currentMonth)
            ->count();


            break;
        case 'personnaliser':
            $startDateTime = $request->input('startDate');
            $endDateTime = $request->input('endDate');

            $resultsUrbain = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantUrbain'))
            ->where('srtk_voyage.ligne_id', '>=', 2000)
            ->where('srtk_voyage.ligne_id', '<', 6000)
            ->whereBetween('srtk_voyage.date_voyage',[$startDateTime, $endDateTime])
            ->first();
            $totalMontantUrbain = $resultsUrbain->totalMontantUrbain ?? 0;

        $resultsB = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantB'))
            ->where('srtk_voyage.ligne_id', '>=', 1000)
            ->where('srtk_voyage.ligne_id', '<', 2000)
            ->whereBetween('srtk_voyage.date_voyage',[$startDateTime, $endDateTime])
            ->first();
            $totalMontantB = $resultsB->totalMontantB ?? 0;

            $resultsEntreV = Voyage::join('srtk_caisse', 'srtk_voyage.id', '=', 'srtk_caisse.voyage_id')
            ->select(DB::raw('SUM(srtk_caisse.montant) as totalMontantEntreV'))
            ->where('srtk_voyage.ligne_id', '<', 1000)
            ->where('srtk_voyage.ligne_id', '<=', 6000)
            
            ->whereBetween('srtk_voyage.date_voyage',[$startDateTime, $endDateTime])

            ->first();
            $totalMontantEntreV= $resultsEntreV->totalMontantEntreV ?? 0;
            $Totale = $totalMontantUrbain+ $totalMontantB + $totalMontantEntreV ;

 
            


            $chequeT= Reservation::where('type_payement', 2)
            ->whereBetween('date_voyage',[$startDateTime, $endDateTime])
            ->sum('montant_cheque');

            
        
        $cashT = Reservation::where('type_payement', 1)
        ->whereBetween('date_voyage',[$startDateTime, $endDateTime])
        ->sum('montant_espece');
            
            $chequeCount = Reservation::where('type_payement', 2)
            ->whereBetween('date_voyage',[$startDateTime, $endDateTime])
            ->count();
            $cashCount = Reservation::where('type_payement', 1)
            ->whereBetween('date_voyage',[$startDateTime, $endDateTime])
            ->count();



            

            break;
     

        default:
            $date = date('Y-m-d');
            break;
    }

    return view('dashboard',compact('totalMontantUrbain','totalMontantB','totalMontantEntreV','Totale','chequeCount','cashCount','cashT','chequeT'));
}

        }

    

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Voyage;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Carbon\Carbon; // Make sure to import Carbon
use App\Models\Employee;
use App\Models\TicketVoyage;



class ResumeController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $datee = date('Y-m-d');
        if($request->input('daterap')){
            $datee= $request->input('daterap');
        }
     
        $resultsVoyageurUrbain =Voyage::whereBetween('ligne_id', [2000, 5999])
        ->where('date_voyage', $datee)
        ->get();
        //var_dump($resultsVoyageurUrbain);exit;
        $totalMontantU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurB =Voyage::whereBetween('ligne_id', [1000, 1999])
        ->where('date_voyage', $datee)
        ->get();

        $totalMontantB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurEntreV =Voyage::where('ligne_id', 0)
        ->where('date_voyage', $datee)
        ->get();

        $totalMontantV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });
$Totale=$totalMontantV+$totalMontantU+$totalMontantB;
        $chequeT= Reservation::where('type_payement', 2)
        ->whereDate('date_voyage', $datee)
        ->sum('montant_cheque');

        
    
    $cashT = Reservation::where('type_payement', 1)
        ->whereDate('date_voyage', $datee)
        ->sum('montant_espece');

        $reservations = Reservation::whereDate('date_voyage', '=', $datee)->get();
        // In your controller or wherever you're retrieving the data
        $voyagesWithoutCaisse = Employee::where('type_id', 4)
    ->whereHas('voyages', function ($query) use ($datee) {
        
        $query->whereNotIn('id', TicketVoyage::pluck('voyage_id'))
        ->where('date_voyage', '=', $datee);
    })
    ->get();


 ///   var_dump($voyagesWithoutCaisse);exit;


        return view('resume/resume',compact('totalTicketV','totalTicketB','totalTicketU','totalMontantV','totalMontantU','totalMontantB','Totale','cashT','chequeT','reservations','voyagesWithoutCaisse','datee'));
    }

    public function generatePDF(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $datee = date('Y-m-d');
        if ($request->input('daterap')) {
            $datee = $request->input('daterap');
        }
     
        $resultsVoyageurUrbain =Voyage::whereBetween('ligne_id', [2000, 5999])
        ->where('date_voyage', $datee)
        ->get();
        //var_dump($resultsVoyageurUrbain);exit;
        $totalMontantU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketU = $resultsVoyageurUrbain->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurB =Voyage::whereBetween('ligne_id', [1000, 1999])
        ->where('date_voyage', $datee)
        ->get();

        $totalMontantB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketB = $resultsVoyageurB->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });

        $resultsVoyageurEntreV =Voyage::where('ligne_id', 0)
        ->where('date_voyage', $datee)
        ->get();

        $totalMontantV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket') * $voyage->ticketVoyages->sum('ticket.prix');
        });
        $totalTicketV = $resultsVoyageurEntreV->sum(function ($voyage) {
            return $voyage->ticketVoyages->sum('nbre_ticket');
        });
$Totale=$totalMontantV+$totalMontantU+$totalMontantB;

        $chequeT= Reservation::where('type_payement', 2)
        ->whereDate('date_voyage', $datee)
        ->sum('montant_cheque');

        
    
    $cashT = Reservation::where('type_payement', 1)
        ->whereDate('date_voyage', $datee)
        ->sum('montant_espece');

        $reservations = Reservation::whereDate('date_voyage', '=', $datee)->get();
        $voyagesWithoutCaisse = Employee::where('type_id', 4)
        ->whereHas('voyages', function ($query) use ($datee){
            $query->whereNotIn('id', TicketVoyage::pluck('voyage_id'));
            $query->where('date_voyage', '=', $datee);
        })
        ->get();
             $data = [
            'title' => 'حوصلة النشاط اليومي',
            'datee'=>$datee,
            'totalMontantU' => $totalMontantU,
            'totalMontantB' => $totalMontantB,
            'totalMontantV' => $totalMontantV,

            'totalTicketU' => $totalTicketU,
            'totalTicketV' => $totalTicketV,
            'totalTicketB' => $totalTicketB,

            'Totale' => $Totale,
            'chequeT' => $chequeT,
            'cashT' => $cashT,
            'reservations' => $reservations,
            'voyagesWithoutCaisse' => $voyagesWithoutCaisse,
        ];
    
        $mpdf = new Mpdf(['orientation' => 'L']); // Set orientation to landscape
$mpdf->WriteHTML(view('resume.pdf', $data));

return response($mpdf->Output(), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="document.pdf"',
]);

    
    }
}

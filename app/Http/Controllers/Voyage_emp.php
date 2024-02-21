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

class Voyage_emp extends Controller
{
    public function index()
    {
        return view('loginemp');
    }




    public function list_voyage(Request $request){
        $cin=$request->cin;
        $today = Carbon::now()->toDateString();
        $datee = date('Y-m-d');
        $today = Carbon::now()->toDateString();
        $datee = date('Y-m-d');

        $deb=$request->date_deb;
        $fin=$request->date_fin;
        $employee = Employee::where('matricule_employee',$cin)
        ->first();
        if($employee){
        
        if($deb=='' and $fin==''){
            $voyage = Voyage::join('srtk_ligne', 'srtk_ligne.id', '=', 'srtk_voyage.ligne_id')
        ->where(function($query) use ($employee) {
            $query->where('chauffeur_id', $employee->id)
                  ->orWhere('receveur_id', $employee->id);
        })
        ->where('date_voyage', $datee)
        ->get();
    }
    else if($deb!='' and $fin==''){
        $voyage = Voyage::join('srtk_ligne', 'srtk_ligne.id', '=', 'srtk_voyage.ligne_id')
        ->where(function($query) use ($employee) {
            $query->where('chauffeur_id', $employee->id)
                  ->orWhere('receveur_id', $employee->id);
        })
        ->where('date_voyage','>', $deb)
        ->where('date_voyage','<',$datee)
        ->get();
    }
    else if($deb!='' and $fin!=''){
        $voyage = Voyage::join('srtk_ligne', 'srtk_ligne.id', '=', 'srtk_voyage.ligne_id')
        ->where(function($query) use ($employee) {
            $query->where('chauffeur_id', $employee->id)
                  ->orWhere('receveur_id', $employee->id);
        })
        ->where('date_voyage','>', $deb)
        ->where('date_voyage','<',$fin)
        ->get();
    }
        $data = [
            'title' => 'رحلات',
            'employee'=>$employee,
            'voyage'=>$voyage,
            'datee'=>$datee,
            'deb'=>$deb,
            'fin'=>$fin
         
        ];
    
        $mpdf = new Mpdf(['orientation' => 'L']); // Set orientation to landscape
$mpdf->WriteHTML(view('pdfvoyage',$data, compact('cin')));

return response($mpdf->Output(), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="document.pdf"',
]);
}
else {
   return redirect("/voyage_emp");
}

    }
}

@extends('layouts.master')
@section('title')

@endsection

@section('content')
<style>
    .table{
        text-align: center;

    }
    .table thead{
        font-weight: bold;
            }



</style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


          <form class="form-inline" method="GET" action="{{ route('resume') }}">       <div class="row">
             <div class="col-6">
<input type="date" name="daterap" class="form-control"></div> <div class="col-3"><button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i></button></div>
</div>     
</form>

<br>  
<h3 style="text-align:center;color:darkcyan;margin-bottom:5%">حوصلة النشاط اليومي <?php echo $datee;?></h3>

        <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>   </th>
                        <th> بين المدن </th>
                        <th> النقل الحضري</th>
                        <th> النقل البلدي</th>
                        <th> مجموع  السفرات</th>
                    </tr>
                </thead>
                <tbody>
        <tr>
            <td>المداخيل بالمليم</td>
            <td><?php echo number_format($totalMontantV, 3, '.', '');
?></td>
            <td><?php echo number_format($totalMontantU, 3, '.', '');?></td>
            <td><?php echo number_format($totalMontantB, 3, '.', '')?></td>
            <td><?php echo number_format($Totale,  3, '.', '')?></td>
                   </tr>

                   <tr>
            <td>عدد المسافرين</td>
            <td><?php echo $totalTicketV?></td>
            <td><?php echo $totalTicketU?></td>
            <td><?php echo $totalTicketB?></td>
            <td><?php echo $totalTicketU+$totalTicketV+$totalTicketB?></td>
                   </tr>
                   <tr>
            <td> عدم المحاسبة</td>
            <td colspan="4" style="margin-right:5px">
    @foreach($voyagesWithoutCaisse as $receveur)
        {{ $receveur->nom }} /
    @endforeach
</td>

        
                   </tr>
</tbody>


            </table>

           

            <h3 style="margin-top:2%;margin-bottom:2%;text-align:center;text-decoration:underline">الرحلات</h3>

            <table class="table table-bordered" >
                    <thead class="table-primary">
                        <tr>
                            <th rowspan="2"> تاريخ الحجز </th>
                            <th rowspan="2"> طالب الخدمة </th>
                            <th rowspan="2"> مكان الانطلاق/مكان الوصول </th>
                            <th colspan="2">المداخيل نقدا</th>
                            <th colspan="3">المداخيل بالشيك</th>
                        </tr>
                        <tr>
                            <th>المبلغ نقدا</th>
                            <th>عدد الوصل</th>
                            <th> المبلغ بالشيك</th>
                            <th>رقم الشيك</th>
                            <th>البنك</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->date_voyage }}</td>
                                <td>{{ $reservation->client }}</td>
                                <td>{{ $reservation->station_debut }} / {{ $reservation->station_fin }}</td>
                                <td>{{  number_format($reservation->montant_espece,  3, '.', '')?? '' }}</td>
                                <td>{{ $reservation->num_paiement ?? '' }}</td>
                                <td>{{  number_format($reservation->montant_cheque,  3, '.', '')?? '' }}</td>
                                <td>{{ $reservation->num_cheque ?? '' }}</td>
                                <td>{{ $reservation->banque ?? '' }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-bottom: 20px;"></div>


                <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>   </th>
                        <th> مجموع مداخيل السفرات نقدا </th>
                        <th>  مداخيل الرحلات نقدا</th>
                        <th>  مداخيل الرحلات بالشيك</th>

                        <th>  المجموع العام للمداخيل اليومية نقدا  </th>
                    </tr>
                </thead>
                <tbody>
        <tr>
            <td>المداخيل بالمليم</td>
            <td><?php echo number_format($Totale,  3, '.', '') ?></td>
            <td><?php echo number_format($cashT,  3, '.', '');?></td>
            <td><?php echo number_format($chequeT,  3, '.', '');?></td>

            <td><?php $T= $cashT+ $Totale+$chequeT;
            echo number_format($T,  3, '.', '')?></td>
                   </tr>
</tbody>


            </table>

            <table class="table table-bordered" style="margin-top:2%;margin-bottom:2%;">
                <thead>
                    <tr>
                        <th class="table-primary">   مرا قب المداخيل ز الاسم و اللقب و الامضاء و الختم</th>
                        <th class="table-primary"> رئيس المصلحة التجارية ز الامضاء و الختم  </th>
                    </tr>
                </thead>
            


            </table>
        <a href="{{ route('resume.download') }}?daterap=<?=$datee?>" class="btn btn-inverse-info btn-fw" target="_blank"style="margin-right:50%"><i class="mdi mdi-cloud-download"></i> </a>



            

        </div>
    </div>
@endsection

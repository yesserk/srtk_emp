@extends('layouts.master')

@section('title', 'الرحلات')

@section('content')

<style>
    #amountContainer {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
        width: 75%;
    }
</style>

    <a href="{{ route('voyage.create') }}" class="btn btn-inverse-info btn-fw">اضافة رحلة</a>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            <form action="{{ route('voyage') }}" method="GET">
    <div class="row">
   
        <div class="col-md-5">
            <div class="form-group">
                <label for="filter_date">حسب يوم الرحلة</label>
                <input type="date" name="filter_date" id="filter_date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="filter_gare">حسب النيابة</label>
                <select name="filter_gare" id="filter_gare" class="form-control form-control-sm">
            <option value="">اختر النيابة</option>
            @foreach ($gares as $gare)
                <option value="{{ $gare->id }}">{{ $gare->gare }}</option>
            @endforeach
        </select>
            </div>
        </div>
        <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-sm"> بحث</button>

        </div>
        
    </div>
</form>


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th></th>
                            <th>اليوم</th>
                            <th>الانطلاق</th>
                            <th>الخط</th>
                            <th>المحطات</th>
                         <!--   <th>عدد المسافرين</th>
                            <th> المبلغ</th>
-->
                            <th style="width:20%"></th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($voyages as $voyage)
        <tr>
        <td>{{ $voyage->id }}</td>
            <td class="{{ $voyage->date_voyage == now()->toDateString() ? 'table-danger' : '' }}">{{ $voyage->date_voyage }}</td>
            <td>{{ $voyage->heur_depart }}</td>
            <td>
                @if ($voyage->ligne)
                    {{ $voyage->ligne->ligne }}
                @endif
            </td>
            <td>
                @if ($voyage->ligne && $voyage->ligne->stations)
                    @foreach ($voyage->ligne->stations as $station)
                        {{ $station->station }}<br>
                    @endforeach
                @endif
            </td>
          
       <!--     <td>
            @php
                        $totalTickets = $voyage->ticketVoyages->sum('nbre_ticket');
                    @endphp
                    {{ $totalTickets }}
</td>
<td>
@php
                        $totalMontant = $voyage->ticketVoyages->sum(function ($ticketVoyage) {
                            return $ticketVoyage->nbre_ticket * $ticketVoyage->ticket->prix;
                        });
                    @endphp
                   <spam style="width:50%"> {{ number_format($totalMontant,  3, '.', '') }}</spam>
       

</td>-->


            <th class="button-container">
           <!-- <a href="{{ route('voyageur.create', $voyage->id) }}" class="btn btn-sm" style="background: #edbc11; color: white;">  التذاكر</a>
                    -->
                <form action="{{ route('voyage.destroy', $voyage->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete"></i></button>
                </form>

                


                
                
               
            </th>
        </tr>
    @endforeach
</tbody>




                </table>
            </div>
    </div>
@endsection

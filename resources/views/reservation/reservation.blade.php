@extends('layouts.master')
@section('title')
    الحجوزات
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
    <a href="{{ route('reservation.create') }}" class="btn btn-inverse-info btn-fw">اضافة حجز</a>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-md-6">
                    <form method="GET" action="{{ route('reservation') }}">
                        <div class="input-group">
                            <input type="date" name="search" class="form-control" value="<?php echo date('Y-m-d');?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-bordered">
                    <thead>
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
                                <th class="button-container">
                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
                                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    @if ($reservations->onFirstPage())
                        <span>&laquo;</span>
                        <span>&lsaquo;</span>
                    @else
                        <a href="{{ $reservations->previousPageUrl() }}">&laquo;</a>
                        <a href="{{ $reservations->url(1) }}">&lsaquo;</a>
                    @endif

                    @php
                        $totalPages = ceil($totalreservations / $reservations->perPage());
                    @endphp

                    @for ($i = 1; $i <= $totalPages; $i++)
                        @if ($i == $reservations->currentPage())
                            <span class="active">{{ $i }}</span>
                        @else
                            <a href="{{ $reservations->url($i) }}{{ isset($search) ? '?search=' . $search : '' }}">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($reservations->hasMorePages())
                        <a href="{{ $reservations->url($totalPages) }}">&rsaquo;</a>
                        <a href="{{ $reservations->nextPageUrl() }}">&raquo;</a>
                    @else
                        <span>&rsaquo;</span>
                        <span>&raquo;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
الحالات
@endsection

@section('content')
<a href="{{ route('etat_employees.create') }}" class="btn btn-inverse-info btn-fw">اضافة حالة الموظف</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6"> <!-- Colonne de 6 colonnes -->
    <form method="GET" action="{{ route('etat_employees.search_etat_employee') }}">
        <div class="input-group">
            <input type="text" name="search" class="form-control " placeholder="بحث..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i></button>
            </div>
        </div>
    </form>
</div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> الحالة </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($etats as $etat)
        <tr>
            <td>{{ $etat->etat }}</td>
       
            <th class="button-container">
    <a href="{{ route('etat_employees.edit', $etat->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('etat_employees.destroy', $etat->id) }}" method="POST" style="display: inline;">
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
    @if ($etats->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $etats->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $etats->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalEtats / $etats->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $etats->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $etats->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($etats->hasMorePages())
        <a href="{{ $etats->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $etats->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>

        </div>
    </div>
</div>
@endsection

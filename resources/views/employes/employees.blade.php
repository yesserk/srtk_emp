@extends('layouts.master')
@section('title')
الموظفين
@endsection

@section('content')
<a href="{{ route('employees.create') }}" class="btn btn-inverse-info btn-fw">اضافة موظف</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-6"> <!-- Colonne de 6 colonnes -->
    <form method="GET" action="{{ route('employees.search_employee') }}">
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
                        <th> اسم </th>
                        <th> رقم بطاقة التعريف </th>
                        <th> هاتف </th>
                        <th> رقم الموظف  </th>
                        <th> الدرجة  </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->nom }}</td>
            <td>{{ $employee->cin }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->matricule_employee }}</td>
            <td>{{ $employee->type->type_employee }}</td>

<th class="button-container">
    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
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
    @if ($employees->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $employees->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $employees->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalEmployees / $employees->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $employees->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $employees->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($employees->hasMorePages())
        <a href="{{ $employees->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $employees->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>




        </div>
    </div>
</div>
@endsection

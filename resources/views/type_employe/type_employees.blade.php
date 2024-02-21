@extends('layouts.master')
@section('title')
الوظائف
@endsection

@section('content')
<a href="{{ route('type_employees.create') }}" class="btn btn-inverse-info btn-fw">اضافة وظيفة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6"> <!-- Colonne de 6 colonnes -->
    <form method="GET" action="{{ route('type_employees.search_type_employee') }}">
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
                        <th> وظيفة </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($types as $type)
        <tr>
            <td>{{ $type->type_employee }}</td>
           

            <th class="button-container">
    <a href="{{ route('type_employees.edit', $type->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('type_employees.destroy', $type->id) }}" method="POST" style="display: inline;">
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
    @if ($types->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $types->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $types->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalTypes / $types->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $types->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $types->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($types->hasMorePages())
        <a href="{{ $types->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $types->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>

        </div>
    </div>
</div>
@endsection

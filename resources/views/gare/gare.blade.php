@extends('layouts.master')
@section('title')
النيابات
@endsection

@section('content')
<a href="{{ route('gare.create') }}" class="btn btn-inverse-info btn-fw">اضافة نيابة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6"> <!-- Colonne de 6 colonnes -->
    <form method="GET" action="{{ route('gare.search_gare') }}">
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
                        <th> النيابة </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($gares as $gare)
        <tr>
            <td>{{ $gare->gare }}</td>
            <th class="button-container">
    <a href="{{ route('gare.edit', $gare->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('gare.destroy', $gare->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete"></i></button>
    </form>
</th>



        </tr>
    @endforeach
</tbody>


            </table>

<!-- Your table here -->

<div class="pagination">
    @if ($gares->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $gares->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $gares->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalGares / $gares->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $gares->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $gares->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($gares->hasMorePages())
        <a href="{{ $gares->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $gares->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>

</div>
@endsection

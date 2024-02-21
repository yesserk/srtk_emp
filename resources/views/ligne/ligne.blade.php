@extends('layouts.master')
@section('title')
الخطوط
@endsection

@section('content')
<a href="{{ route('ligne.create') }}" class="btn btn-inverse-info btn-fw">اضافة خط</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6">
    <form method="GET" action="{{ route('ligne.search_ligne') }}">
        <div class="input-group">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-magnify"></i></button>
            </div>
        </div>
    </form>
</div>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> الخط </th>
                        <th> رقم الخط</th>
                   <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($lignes as $ligne)
        <tr>
            <td>{{ $ligne->ligne }}</td>
            <td>{{ $ligne->num_ligne }}</td>
           
            <th class="button-container">
    <a href="{{ route('ligne.edit', $ligne->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('ligne.destroy', $ligne->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete"></i></button>
    </form>
    <a href="{{ route('ligne.stations', $ligne->id) }}" class="btn btn-warning btn-sm" style="margin-top: 0;"><i class=" syr mdi mdi-glass-stange menu-icon"></i>محطات</a>
</th>

        </tr>
    @endforeach
</tbody>


            </table>

            <div class="pagination">
    @if ($lignes->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $lignes->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $lignes->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalLignes / $lignes->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $lignes->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $lignes->url($i) }}{{ isset($search) ? '?search=' . $search : '' }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($lignes->hasMorePages())
        <a href="{{ $lignes->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $lignes->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>

        </div>
    </div>
</div>
@endsection

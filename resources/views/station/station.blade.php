@extends('layouts.master')
@section('title')
المحطات
@endsection

@section('content')
<a href="{{ route('station.create') }}" class="btn btn-inverse-info btn-fw">اضافة محطة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6">
    <form method="GET" action="{{ route('stations.search_station') }}">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ $search }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i></button>
            </div>
        </div>
    </form>
</div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> المحطة </th>
                        <th> رقم المحطة </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($stations as $station)
        <tr>
            <td>{{ $station->station }}</td>
            <td>{{ $station->num_station }}</td>
           
            <th class="button-container">
    <a href="{{ route('station.edit', $station->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('station.destroy', $station->id) }}" method="POST" style="display: inline;">
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
    @if ($stations->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $stations->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $stations->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalStations / $stations->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $stations->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $stations->url($i) }}{{ isset($search) ? '?search=' . $search : '' }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($stations->hasMorePages())
        <a href="{{ $stations->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $stations->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>
        </div>
    </div>
</div>
@endsection

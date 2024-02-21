@extends('layouts.master')
@section('title')
التذاكر
@endsection

@section('content')
<a href="{{ route('ticket.create') }}" class="btn btn-inverse-info btn-fw">اضافة تذكرة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6">
    <form method="GET" action="{{ route('tickets.search_ticket') }}">
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
                        <th> النوع </th>
                        <th>  الثمن </th>
                        <th>   </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->genre }}</td>
            <td>{{ $ticket->prix }}</td>
            <td><?php if($ticket->personalise==0){ echo 'ثابت';}else{echo 'متغير';}?></td>
            <th class="button-container">
    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" style="display: inline;">
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
    @if ($tickets->onFirstPage())
        <span>&laquo;</span>
        <span>&lsaquo;</span>
    @else
        <a href="{{ $tickets->previousPageUrl() }}">&laquo;</a>
        <a href="{{ $tickets->url(1) }}">&lsaquo;</a>
    @endif

    @php
        $totalPages = ceil($totalTickets / $tickets->perPage());
    @endphp

    @for ($i = 1; $i <= $totalPages; $i++)
        @if ($i == $tickets->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $tickets->url($i) }}{{ isset($search) ? '?search=' . $search : '' }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($tickets->hasMorePages())
        <a href="{{ $tickets->url($totalPages) }}">&rsaquo;</a>
        <a href="{{ $tickets->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&rsaquo;</span>
        <span>&raquo;</span>
    @endif
</div>
        </div>
    </div>
</div>
@endsection

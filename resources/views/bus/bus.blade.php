@extends('layouts.master')
@section('title')
الحافلات
@endsection

@section('content')
<a href="{{ route('bus.create') }}" class="btn btn-inverse-info btn-fw">اضافة حافلة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-6">
    <form method="GET" action="{{ route('bus.search_bus') }}">
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
                        <th> رمز </th>
                        <th> تسجيل </th>
                        <th> نوع</th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($Tbus as $bus)
        <tr>
            <td>{{ $bus->code_car }}</td>
            <td>{{ $bus->immatriculation }}</td>
            <td>{{ $bus->marque }}</td>
            <th class="button-container">
    <a href="{{ route('bus.edit', $bus->code_car) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('bus.destroy', $bus->code_car) }}" method="POST" style="display: inline;">
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
</div>
@endsection

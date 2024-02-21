@extends('layouts.master')

@section('title')
    المبلغ
@endsection

@section('content')
<a href="{{ route('bus.create') }}" class="btn btn-inverse-info btn-fw">اضافة المبلغ</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

      
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> تاريخ </th>
                        <th> مبلغ </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caisses as $caisse)
                        <tr>
                            <td>{{ $caisse->date }}</td>
                            <td>{{ $caisse->montant }}</td>
                            <th class="button-container">
                                <a href="{{ route('caisse.edit', $caisse->id) }}" class="btn btn-success btn-sm">
                                    <i class="mdi mdi-grease-pencil"></i>
                                </a>
                                <form action="{{ route('caisse.destroy', $caisse->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
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

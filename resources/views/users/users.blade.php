@extends('layouts.master')
@section('title')
المستخدمين
@endsection

@section('content')
<a href="{{ route('users.create') }}" class="btn btn-inverse-info btn-fw">اضافة مستخدم</a>

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
                        <th> مستخدم </th>
                        <th> email </th>
                        <th> التصاريح </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>


            <th class="button-container">
            @if(auth()->user()->id !== $user->id)
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete"></i></button>
    </form>
    <a href="{{ route('users.permission', $user->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-account-star"></i></a>

    @endif
</th>
            
        </tr>
    @endforeach
</tbody>


            </table>
        </div>
    </div>
</div>
@endsection

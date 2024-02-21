
@extends('layouts.master')
@section('title')

اضافة الحالة
@endsection



@section('content')
<div class="card">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card-body">
    <form method="POST" action="{{ route('etat_employees.store') }}">
        @csrf

            <div class="form-group">
                <label for="etat">الحالة</label>
                <input type="text" name="etat" value="{{ old('etat') }}" class="form-control" required placeholder="الحالة">
            </div>


        <button type="submit" class="btn btn-primary">إضافة الحالة</button>
    </form>
</div>
</div>
@endsection
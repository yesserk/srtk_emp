
@extends('layouts.master')
@section('title')

تعديل الحالة
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
<form method="POST" action="{{ route('etat_employees.update', $etatEmployee->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
    <div class="form-group">
        <label for="etat_employee">الحالة</label>
        <input type="text" name="etat" value="{{ $etatEmployee->etat }}" class="form-control" required placeholder="الوظيفة">
    </div>
    <button type="submit" class="btn btn-primary">تحديث الحالة</button>
</form>

</div>
</div>
@endsection
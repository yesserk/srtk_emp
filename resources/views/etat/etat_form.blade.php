
@extends('layouts.master')
@section('title')

اضافة حالة
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
    <form method="POST" action="{{ route('etat.store') }}">
        @csrf

            <div class="form-group">
                <label for="employee_id">الموظف</label>
                <select class="form-control" id="exampleFormControlSelect2" name="employee_id" required>
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->nom }}</option>
        @endforeach
    </select>
            </div>

            <div class="form-group">
                <label for="etat_id">الحالة</label>
                <select class="form-control" id="exampleFormControlSelect2" name="etat_id" required>
        @foreach($etats as $etat)
            <option value="{{ $etat->id }}">{{ $etat->etat }}</option>
        @endforeach
    </select>
            </div>

            <div class="form-group">
                <label for="date_etat">التاريخ</label>
                <input type="date" name="date_etat" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
            </div>



        <button type="submit" class="btn btn-primary">إضافة الوظيفة</button>
    </form>
</div>
</div>
@endsection
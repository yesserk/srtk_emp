
@extends('layouts.master')
@section('title')

اضافة موظف
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
    <form method="POST" action="{{ route('employees.store') }}">
        @csrf

        <div class="form-group">
            <label for="nom">الاسم</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" required placeholder="الاسم">
        </div>

        <div class="form-group">
            <label for="date_naissance">تاريخ الميلاد</label>
            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" required placeholder="رقم الهاتف" minlength="8" maxlength="8">
        </div>

        <div class="form-group">
            <label for="cin">رقم البطاقة الوطنية</label>
            <input type="text" name="cin" value="{{ old('cin') }}" class="form-control" required placeholder="رقم البطاقة الوطنية" minlength="8" maxlength="8">
        </div>

        <div class="form-group">
            <label for="matricule_chauffeur">رقم السائق</label>
            <input type="text" name="matricule_employee" value="{{ old('matricule_employee') }}" class="form-control" required placeholder="رقم السائق" minlength="12" maxlength="12">
        </div>

        <div class="form-group">
    <label for="type_id">المسمى الوظيفي</label>
    <select class="form-control" id="exampleFormControlSelect2" name="type_id" required>
        @foreach($type_employees as $type_empl)
            <option value="{{ $type_empl->id }}">{{ $type_empl->type_employee }}</option>
        @endforeach
    </select>
</div>
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" required>

        <div class="form-group">
            <label for="date_embauche">تاريخ التوظيف</label>
            <input type="date" name="date_embauche" value="{{ old('date_embauche') }}" class="form-control" required>
        </div>



        <button type="submit" class="btn btn-primary">إضافة موظف</button>
    </form>
</div>
</div>
@endsection
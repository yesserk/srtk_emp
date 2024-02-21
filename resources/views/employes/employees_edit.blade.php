@extends('layouts.master')
@section('title', 'تعديل موظف')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">تعديل موظف</h4>
            <form method="POST" action="{{ route('employees.update', $employee->id) }}">
    @csrf
    @method('PUT')
                
                <div class="form-group">
        <label for="nom">الاسم</label>
        <input type="text" name="nom" value="{{ isset($employee) ? $employee->nom : old('nom') }}" class="form-control" required placeholder="الاسم">
    </div>

    <div class="form-group">
        <label for="date_naissance">تاريخ الميلاد</label>
        <input type="date" name="date_naissance" value="{{ isset($employee) ? $employee->date_naissance : old('date_naissance') }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="phone">رقم الهاتف</label>
        <input type="tel" name="phone" value="{{ isset($employee) ? $employee->phone : old('phone') }}" class="form-control" required placeholder="رقم الهاتف" minlength="8" maxlength="8">
    </div>

    <div class="form-group">
        <label for="cin">رقم البطاقة الوطنية</label>
        <input type="text" name="cin" value="{{ isset($employee) ? $employee->cin : old('cin') }}" class="form-control" required placeholder="رقم البطاقة الوطنية" minlength="8" maxlength="8">
    </div>

    <div class="form-group">
        <label for="matricule_chauffeur">رقم السائق</label>
        <input type="text" name="matricule_employee" value="{{ isset($employee) ? $employee->matricule_employee : old('matricule_employee') }}" class="form-control" required placeholder="رقم السائق" minlength="12" maxlength="12">
    </div>

    <div class="form-group">
        <label for="type_id">المسمى الوظيفي</label>
        <select class="form-control" id="exampleFormControlSelect2" name="type_id" required>
            @foreach($type_employees as $type_empl)
            <option value="{{ $type_empl->id }}" @if($type_empl->id == $employee->type_id) selected @endif>
                {{ $type_empl->type_employee }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="date_embauche">تاريخ التوظيف</label>
        <input type="date" name="date_embauche" value="{{ isset($employee) ? $employee->date_embauche : old('date_embauche') }}" class="form-control" required>
    </div>

   

    <button type="submit" class="btn btn-primary">
        {{ isset($employee) ? 'تحديث الموظف' : 'إضافة موظف' }}
    </button>
            </form>
        </div>
    </div>
</div>
@endsection

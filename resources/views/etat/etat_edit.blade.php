
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
<form method="POST" action="{{ route('etat.update', $id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
  <div class="form-group">
        <label for="etat_employee">الموظف</label>
         <select class="form-control" id="exampleFormControlSelect2" name="employe" required>
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}" <?php if($etatEmployee->employee_id == $employee->id){ echo "selected";} ?>>{{ $employee->nom }}</option>
        @endforeach   </select></div>


    <div class="form-group">
        <label for="etat_employee">الحالة</label>
         <select class="form-control" id="exampleFormControlSelect2"  name="etat" required>
        @foreach($etats as $etat)
            <option value="{{ $etat->id }}" <?php if($etatEmployee->etat_id == $etat->id){ echo "selected";} ?>>{{ $etat->etat }}</option>
        @endforeach   </select></div>
         <div class="form-group">
                <label for="date_etat">التاريخ</label>
              <input type="date" name="date_etat" value="<?= date('Y-m-d', strtotime($etatEmployee->date_etat)); ?>" class="form-control" required>
            </div>
    <button type="submit" class="btn btn-primary">تحديث </button>
</form>

</div>
</div>
@endsection
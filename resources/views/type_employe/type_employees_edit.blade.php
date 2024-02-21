
@extends('layouts.master')
@section('title')

اضافة وظيفة
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
<form method="POST" action="{{ route('type_employees.update', $typeEmployee->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
    <div class="form-group">
        <label for="type_employee">الوظيفة</label>
        <input type="text" name="type_employee" value="{{ $typeEmployee->type_employee }}" class="form-control" required placeholder="الوظيفة">
    </div>
    <button type="submit" class="btn btn-primary">تحديث الوظيفة</button>
</form>

</div>
</div>
@endsection
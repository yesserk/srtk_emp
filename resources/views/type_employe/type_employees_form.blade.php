
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
    <form method="POST" action="{{ route('type_employees.store') }}">
        @csrf

            <div class="form-group">
                <label for="type_employee">الوظيفة</label>
                <input type="text" name="type_employee" value="{{ old('type_employee') }}" class="form-control" required placeholder="الوظيفة">
            </div>


        <button type="submit" class="btn btn-primary">إضافة الوظيفة</button>
    </form>
</div>
</div>
@endsection
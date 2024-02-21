
@extends('layouts.master')
@section('title')

اضافة الحافلة
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
    <form method="POST" action="{{ route('bus.store') }}">
        @csrf

            <div class="form-group">
                <label for="code_car">الرمز</label>
                <input type="text" name="code_car" value="{{ old('code_car') }}" class="form-control" required placeholder="الرمز">
            </div>
            <div class="form-group">
                <label for="immatriculation">التسجيل </label>
                <input type="text" name="immatriculation" value="{{ old('immatriculation') }}" class="form-control" required placeholder="التسجيل">
            </div>
            <div class="form-group">
                <label for="marque">النوع</label>
                <input type="text" name="marque" value="{{ old('marque') }}" class="form-control" required placeholder="النوع">
            </div>
           

        <button type="submit" class="btn btn-primary">إضافة الحافلة</button>
    </form>
</div>
</div>
@endsection
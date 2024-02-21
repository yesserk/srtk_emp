
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
<form method="POST" action="{{ route('bus.update', $bus->code_car) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
    <div class="form-group">
                <label for="code_car">الرمز</label>
                <input type="text" name="code_car" value="{{ $bus->code_car}}" class="form-control" required placeholder="الرمز" disabled>
            </div>
            <div class="form-group">
                <label for="immatriculation">التسجيل </label>
                <input type="text" name="immatriculation" value="{{ $bus->immatriculation}}" class="form-control" required placeholder="التسجيل" disabled>
            </div>
            <div class="form-group">
                <label for="marque">النوع</label>
                <input type="text" name="marque" value="{{ $bus->marque}}" class="form-control" required placeholder="النوع">
            </div>
    <button type="submit" class="btn btn-primary">تحديث الحالة</button>
</form>

</div>
</div>
@endsection
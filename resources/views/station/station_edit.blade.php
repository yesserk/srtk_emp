
@extends('layouts.master')
@section('title')

تعديل الخط
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
<form method="POST" action="{{ route('station.update', $station->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
    <div class="form-group">
                <label for="code_car">المحطة</label>
                <input type="text" name="station" value="{{ $station->station}}" class="form-control" required placeholder="المحطة">
            </div>
            <div class="form-group">
                <label for="num_station">رقم المحطة </label>
                <input type="text" name="num_station" value="{{ $station->num_station}}" class="form-control" required placeholder="رقم المحطة">
            </div>
    <button type="submit" class="btn btn-primary">تحديث المحطة</button>
</form>

</div>
</div>
@endsection
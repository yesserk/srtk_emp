
@extends('layouts.master')
@section('title')

اضافة محطة
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
    <form method="POST" action="{{ route('station.store') }}">
        @csrf

            <div class="form-group">
                <label for="station">المحطة</label>
                <input type="text" name="station" value="{{ old('station') }}" class="form-control" required placeholder="المحطة">
            </div>
            <div class="form-group">
                <label for="num_station">رقم المحطة </label>
                <input type="text" name="num_station" value="{{ old('num_station') }}" class="form-control" required placeholder="رقم المحطة">
            </div>
           

        <button type="submit" class="btn btn-primary">إضافة المحطة</button>
    </form>
</div>
</div>
@endsection
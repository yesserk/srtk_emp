
@extends('layouts.master')
@section('title')

اضافة الخط
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
<form method="POST" action="{{ route('ligne.store') }}">
    @csrf

    <div class="form-group">
        <label for="ligne">الخط</label>
        <input type="text" name="ligne" value="{{ old('ligne') }}" class="form-control" required placeholder="الخط">
    </div>
    <div class="form-group">
        <label for="num_ligne">رقم الخط</label>
        <input type="text" name="num_ligne" value="{{ old('num_ligne') }}" class="form-control" required placeholder="رقم الخط">
    </div>


    <button type="submit" class="btn btn-primary">إضافة الخط</button>
</form>



</div>
</div>
@endsection
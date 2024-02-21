
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
<form method="POST" action="{{ route('ligne.update', $ligne->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
    <div class="form-group">
        <label for="ligne">الخط</label>
        <input type="text" name="ligne" value="{{ $ligne->ligne }}" class="form-control" required placeholder="الخط">
    </div>
    <div class="form-group">
        <label for="num_ligne">رقم الخط</label>
        <input type="text" name="num_ligne" value="{{ $ligne->num_ligne }}" class="form-control" required placeholder="رقم الخط">
    </div>


    <button type="submit" class="btn btn-primary">تحديث الخط</button>
</form>


</div>
</div>
@endsection
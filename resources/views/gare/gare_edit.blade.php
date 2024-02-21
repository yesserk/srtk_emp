
@extends('layouts.master')
@section('title')

تعديل النيابة
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
<form method="POST" action="{{ route('gare.update', $gare->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
    <div class="form-group">
                <label for="gare">النيابة</label>
                <input type="text" name="gare" value="{{ $gare->gare}}" class="form-control" required placeholder="النيابة">
            </div>
           
    <button type="submit" class="btn btn-primary">تحديث النيابة</button>
</form>

</div>
</div>
@endsection
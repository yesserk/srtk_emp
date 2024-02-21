
@extends('layouts.master')
@section('title')

اضافة النيابة
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
    <form method="POST" action="{{ route('gare.store') }}">
        @csrf

            <div class="form-group">
                <label for="code_car">النيابة</label>
                <input type="text" name="gare" value="{{ old('gare') }}" class="form-control" required placeholder="النيابة">
            </div>

        <button type="submit" class="btn btn-primary">إضافة النيابة</button>
    </form>
</div>
</div>
@endsection
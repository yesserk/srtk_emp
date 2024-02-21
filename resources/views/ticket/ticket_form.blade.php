
@extends('layouts.master')
@section('title')

اضافة تذكرة
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
    <form method="POST" action="{{ route('ticket.store') }}">
        @csrf

            <div class="form-group">
                <label for="genre">النوع</label>
                <input type="text" name="genre" value="{{ old('genre') }}" class="form-control" required placeholder="النوع">
            </div>
            <div class="form-group">
                <label for="prix">الثمن  </label>
                <input type="text" name="prix" value="{{ old('prix') }}" class="form-control" required placeholder="الثمن">
            </div>
            <div class="form-group">
                <label for="personalise">الحالة  </label>
                <select class="form-control" id="exampleFormControlSelect2" name="personalise" required>
       
            <option value="0">ثابت</option>
            <option value="1">متغير</option>
   
    </select>
            </div>
          

        <button type="submit" class="btn btn-primary">إضافة التذكرة</button>
    </form>
</div>
</div>
@endsection
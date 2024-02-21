
@extends('layouts.master')
@section('title')

تعديل التذكرة
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
<form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
    @csrf
    @method('PUT') <!-- Add this line to override the method as PUT -->
  
    <div class="form-group">
                <label for="genre">النوع</label>
                <input type="text" name="genre" value="{{ $ticket->genre}}" class="form-control" required placeholder="النوع">
            </div>
            <div class="form-group">
                <label for="prix"> الثمن </label>
                <input type="text" name="prix" value="{{ $ticket->prix}}" class="form-control" required placeholder=" الثمن">
            </div>
            
            <div class="form-group">
                <label for="personalise">الحالة  </label>
            <select class="form-control" id="exampleFormControlSelect2" name="personalise" required>
            <option <?php if($ticket->personalise == 0){?> selected <?php } ?>value="0">ثابت</option>
            <option <?php if($ticket->personalise ==1){?> selected <?php } ?>value="1">متغير</option>
            </select>
            </div>
    <button type="submit" class="btn btn-primary">تحديث التذكرة</button>
</form>

</div>
</div>
@endsection
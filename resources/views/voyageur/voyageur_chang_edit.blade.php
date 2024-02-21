@extends('layouts.master')

@section('title')
اضافة العدد
@endsection

@section('content')

<head>
    <!-- Other head elements -->

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="container">
    <h2>اضافة العدد</h2>


  <div class="form-container">

  <form method="POST" action="{{ route('voyageur.update_chang', $ticket_chang->id) }}">
    @csrf
    @method('PUT') 
    <div class="form-group">
        <label for="ticket_id">النوع</label>
        <select name="ticket_id" id="ticket_id" class="form-control form-control-sm mr-2 js-example-basic-single">
            @foreach($tickets as $ticket)
                <option <?php if($ticket_chang->ticket_id == $ticket->id ) {?> selected <?php }?>value="{{ $ticket->id }}">{{ $ticket->genre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="nbre_ticket">العدد</label>
        <input type="number" name="nbre_ticket" id="nbre_ticket" class="form-control" value="{{ $ticket_chang->nbre_ticket }}">
    </div>

  
    <input type="hidden" name="voyage_id" value="{{ $ticket_chang->voyage_id }}" class="form-control">


    <button type="submit" class="btn btn-primary">اضافة العدد</button>


</form>

  
   
  </div>







  
</div>
        </div>
    </div>
</div>



@endsection

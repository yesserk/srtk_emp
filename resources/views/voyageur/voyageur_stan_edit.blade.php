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

  <form method="POST" action="/voyageur/{{ $ticket_stand->id}}">
    <!-- Your form fields and other elements go here -->
    @csrf
    @method('PUT') 
    <div class="form-group">
        <label for="ticket_id">النوع</label>
        <select name="ticket_id" id="ticket_id" class="form-control form-control mr-2 js-example-basic-single">
            @foreach($tickets as $ticket)
                <option <?php if($ticket_stand->ticket_id == $ticket->id ) {?> selected <?php }?>value="{{ $ticket->id }}">{{ $ticket->genre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="debut">البداية</label>
        <input type="number" name="debut" id="debut" class="form-control" value="{{ $ticket_stand->debut }}">
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="fin">النهاية</label>
        <input type="number" name="fin" id="fin" class="form-control" value="{{ $ticket_stand->fin }}">
    </div>
    <input type="hidden" name="voyage_id" value="{{ $ticket_stand->voyage_id }}" class="form-control">

    <!-- Hidden input for nbre_ticket -->
    <input type="hidden" name="nbre_ticket" id="nbre_ticket" value="">

    <button type="submit" class="btn btn-primary">اضافة العدد</button>

    <!-- JavaScript script to calculate nbre_ticket -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var debutInput = document.getElementById('debut');
            var finInput = document.getElementById('fin');
            var nbreTicketInput = document.getElementById('nbre_ticket');

            debutInput.addEventListener('input', calculateNbreTicket);
            finInput.addEventListener('input', calculateNbreTicket);

            function calculateNbreTicket() {
                var debutValue = parseFloat(debutInput.value) || 0;
                var finValue = parseFloat(finInput.value) || 0;
                var nbreTicketValue = finValue - debutValue;

                // Update the hidden input value
                nbreTicketInput.value = nbreTicketValue;
            }
        });
    </script>
</form>

  
   
  </div>







  
</div>
        </div>
    </div>
</div>



@endsection

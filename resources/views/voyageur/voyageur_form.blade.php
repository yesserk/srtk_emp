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

<style>
    .form-container {
      display: none;
    }
  </style>

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

    <div class="row grid-margin stretch-card">
  <div class="col-6">
    <label>
      <input type="radio" name="formSelector" value="0" onclick="showForm('form2')"> متغير
    </label>
  </div>

  <div class="col-6">
    <label>
      <input type="radio" name="formSelector" value="1" onclick="showForm('form1')"> ثابت
    </label>
  </div>
</div>

  <div id="form1" class="form-container">

  <form method="POST" action="{{ route('voyageur.store_stan') }}" id="voyageurForm">
    @csrf

    <div class="form-group">
        <label for="ticket_id">النوع</label>
        <select name="ticket_id" id="ticket_id" class="form-control form-control-sm mr-2 js-example-basic-single">
            @foreach($tickets_stand as $ticket)
                <option value="{{ $ticket->id }}">{{ $ticket->genre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="debut">البداية</label>
        <input type="number" name="debut" id="debut" class="form-control">
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="fin">النهاية</label>
        <input type="number" name="fin" id="fin" class="form-control">
    </div>
    <input type="hidden" name="voyage_id" value="{{ $voyage_id }}" class="form-control">

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

  <div id="form2" class="form-container">
  <form method="POST" action="{{ route('voyageur.store_chang') }}" id="voyageurForm">
    @csrf

    <div class="form-group">
        <label for="ticket_id">النوع</label>
        <select name="ticket_id" id="ticket_id" class="form-control form-control-sm mr-2 js-example-basic-single">
            @foreach($tickets_chang as $ticket)
                <option value="{{ $ticket->id }}">{{ $ticket->genre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group number" id="nbreTicketGroup">
        <label for="nbre_ticket">العدد</label>
        <input type="number" name="nbre_ticket" class="form-control">
    </div>

    <input type="hidden" name="voyage_id" value="{{ $voyage_id }}" class="form-control">
    <button type="submit" class="btn btn-primary">اضافة العدد</button>
</form>

  </div>

  <script>
    function showForm(formId) {
      // Hide all forms
      var forms = document.getElementsByClassName('form-container');
      for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = 'none';
      }

      // Show the selected form
      document.getElementById(formId).style.display = 'block';
    }
  </script>





    <table class="table table-striped">
                <thead>
                    <tr>
                        <th> النوع </th>
                        <th>  العدد </th>
                        <th>  بداية </th>

                        <th>  نهاية </th>

                        <th>  المبلغ </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ticket_voyages as $ticket_voyage)
        <tr>
            <td> {{ $ticket_voyage->ticket->genre }}</td>
            <td>{{ $ticket_voyage->nbre_ticket }}</td>
            <td>{{ $ticket_voyage->debut }}</td>

            <td>{{ $ticket_voyage->fin }}</td>


           
            <td> <?php $money = $ticket_voyage->nbre_ticket * $ticket_voyage->ticket->prix ; echo number_format($money,  3, '.', '') ; ?></td>
            <td>
              <?php if($ticket_voyage->ticket->personalise == 0){ ?>
            <a href="{{ route('voyageur.edit_stan', $ticket_voyage->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
            <?php }else{?>
             
              <a href="{{ route('voyageur.edit_chang', $ticket_voyage->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-grease-pencil"></i></a>

              <?php }?>
            <form action="{{ route('voyageur.destroy', $ticket_voyage->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 0;"><i class="mdi mdi-delete-forever"></i></button>
                </form>
            </td>
           
           
        </tr>
    @endforeach
</tbody>


            </table>
</div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        $('.js-example-basic-single').select2();
    });
</script>


@endsection

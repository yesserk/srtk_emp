<!-- resources/views/voyage/create.blade.php -->

@extends('layouts.master')

@section('title', 'إضافة رحلة')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form method="POST" action="{{ route('voyage.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="gare_id">النيابة </label>
                        <select name="gare_id" class="form-control">
    @foreach ($gares as $gare)
       
            <option value="{{ $gare->id }}">{{ $gare->gare }}</option>
        
    @endforeach
</select>
                    </div>

                    <div class="form-group">
    <label for="ligne_id">اختر الخط</label>
    <select name="ligne_id" class="form-control">
    @foreach ($lignes as $ligne)
       
            <option value="{{ $ligne->id }}">@foreach ($ligne->stations as $station) {{ $station->station }}   @endforeach</option>
        
    @endforeach
</select>
</div>

<div class="form-group">
    <label for="date_voyage"> تاريخ الرحلة</label>
    <input type="date" name="date_voyage" class="form-control" required value="{{ date('Y-m-d') }}">
</div>


                    <div class="form-group">
                        <label for="heur_depart"> الانطلاق </label>
                        <input type="time" name="heur_depart" class="form-control" required>

                    </div>

                    <div class="form-group">
    <label for="bus_id"> الحافلة </label>
    <select name="bus_id" class="form-control">
        @foreach ($Tbus as $bus)
            <option value="{{ $bus->code_car }}">{{ $bus->code_car }}</option>
        @endforeach
    </select>
</div>


                    <div class="form-group">
                        <label for="chauffeur_id"> السائق </label>
                        <select name="chauffeur_id" class="form-control">
    @foreach ($chauffeurs as $chauffeur)
       
            <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}</option>
        
    @endforeach
</select>
                       
                       
                    </div>

                    <div class="form-group">
                        <label for="receveur_id"> القابض </label>
                        <select name="receveur_id" class="form-control">
    @foreach ($receveurs as $receveur)
       
            <option value="{{ $receveur->id }}">{{ $receveur->nom }}</option>
        
    @endforeach
</select>
                       
                    </div>

                    <div class="form-group">
                        <label for="Commentaire"> ملاحظات </label>
                        <textarea name="Commentaire" id="Commentaire" class="form-control" rows="4">{{ old('Commentaire') }}</textarea>

                    </div>
                    
                    <button type="submit" class="btn btn-primary">إضافة الرحلة</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
تعيين محطة
@endsection

@section('content')
<a href="{{ route('ligne.create') }}" class="btn btn-inverse-info btn-fw">تعيين محطة</a>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form method="POST" action="{{ route('ligne.addStation', $lignesy->id) }}">
    @csrf

    <div class="form-group">
        <label for="station_ids">Sélectionnez les stations à ajouter :</label>
        <select name="station" class="form-control">
    @foreach($stations as $station)
        <option value="{{ $station->id }}">{{ $station->station }}</option>
    @endforeach
</select>
<input type="text" hidden name="ligne" value="{{ $lignesy->id }}">
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<table class="table table-striped">
                <thead>
                    <tr>
                        <th> المحطات </th>
                        <th style="width:30%"> </th>
                    </tr>
                </thead>
                <tbody>
    @foreach($lignes as $ligne)
    @if ($ligne->id==$lignesy->id)
    @if ($ligne->stations->count() > 0)
    @foreach ($ligne->stations as $station)

    <tr>
        
            <td>{{ $station->station }}
            </td>
            <th class="button-container">

    <a href="/ligne/station/<?= $ligne->id.'/'. $station->id?>" class="btn btn-danger btn-fw" style="margin-top: 0;">محطات</a>
</th>

        </tr>

        @endforeach
        @else
                لم يتم تخصيص أي محطة لهذا الخط.
                                @endif

        @endif

        @endforeach
</tbody>


            </table>

        </div>
    </div>
</div>
@endsection

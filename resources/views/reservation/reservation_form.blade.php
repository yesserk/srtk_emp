@extends('layouts.master')
@section('title')
    اضافة حجز
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
            <form method="POST" action="{{ route('reservation.store') }}">
                @csrf

                <div class="form-group">
                    <label for="date_voyage">تاريخ الرحلة</label>
                    <input type="date" name="date_voyage" value="{{ old('date_voyage') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="client">طالب الخدمة </label>
                    <input type="text" name="client" value="{{ old('client') }}" class="form-control" required placeholder="طالب الخدمة">
                </div>

                <div class="form-group">
                    <label for="station_debut">مكان الانطلاق </label>
                    <input type="station_debut" name="station_debut" value="{{ old('station_debut') }}" class="form-control" required placeholder="مكان الانطلاق">
                </div>
                <div class="form-group">
                    <label for="station_fin">مكان الوصول </label>
                    <input type="station_fin" name="station_fin" value="{{ old('station_fin') }}" class="form-control" required placeholder="مكان الوصول">
                </div>
                <div class="form-group">
                    <label for="type_payement">طريقة الخلاص  </label>
                    <select name="type_payement" class="form-control" id="type_payement" required>
                        <option value="1" {{ old('type_payement') == 1 ? 'selected' : '' }}>نقداً</option>
                        <option value="2" {{ old('type_payement') == 2 ? 'selected' : '' }}>شيك</option>
                    </select>
                </div>

                <div id="montant_espece_div" class="form-group" style="display: {{ old('type_payement') == 1 ? 'block' : 'none' }}">
                    <label for="montant_espece">المبلغ (نقداً)</label>
                    <input type="text" name="montant_espece" value="{{ old('montant_espece') }}" class="form-control">
                </div>
                <div id="num_paiement_div" class="form-group" style="display: {{ old('type_payement') == 1 ? 'block' : 'none' }}">
                    <label for="num_paiement">عدد الوصل</label>
                    <input type="text" name="num_paiement" value="{{ old('num_paiement') }}" class="form-control">
                </div>

                <div id="montant_cheque_div" class="form-group" style="display: {{ old('type_payement') == 2 ? 'block' : 'none' }}">
                    <label for="montant_cheque">المبلغ (شيك)</label>
                    <input type="text" name="montant_cheque" value="{{ old('montant_cheque') }}" class="form-control">
                </div>
                <div id="num_cheque_div" class="form-group" style="display: {{ old('type_payement') == 2 ? 'block' : 'none' }}">
                    <label for="num_cheque">رقم الشيك</label>
                    <input type="text" name="num_cheque" value="{{ old('num_cheque') }}" class="form-control">
                </div>
                <div id="banque_div" class="form-group" style="display: {{ old('type_payement') == 2 ? 'block' : 'none' }}">
                    <label for="banque">البنك</label>
                    <input type="text" name="banque" value="{{ old('banque') }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">إضافة الحجز</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var typePayementSelect = document.getElementById('type_payement');
            var montantEspeceDiv = document.getElementById('montant_espece_div');
            var numPaiementDiv = document.getElementById('num_paiement_div');
            var montantChequeDiv = document.getElementById('montant_cheque_div');
            var numChequeDiv = document.getElementById('num_cheque_div');
            var banqueDiv = document.getElementById('banque_div');

            typePayementSelect.addEventListener('change', function () {
                if (typePayementSelect.value == 1) {
                    montantEspeceDiv.style.display = 'block';
                    numPaiementDiv.style.display = 'block';
                    montantChequeDiv.style.display = 'none';
                    numChequeDiv.style.display = 'none';
                    banqueDiv.style.display = 'none';
                } else if (typePayementSelect.value == 2) {
                    montantEspeceDiv.style.display = 'none';
                    numPaiementDiv.style.display = 'none';
                    montantChequeDiv.style.display = 'block';
                    numChequeDiv.style.display = 'block';
                    banqueDiv.style.display = 'block';
                } else {
                    montantEspeceDiv.style.display = 'none';
                    numPaiementDiv.style.display = 'none';
                    montantChequeDiv.style.display = 'none';
                    numChequeDiv.style.display = 'none';
                    banqueDiv.style.display = 'none';
                }
            });
        });
    </script>

@endsection

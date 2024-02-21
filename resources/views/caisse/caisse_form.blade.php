@extends('layouts.master')

@section('title')
اضافة المبلغ
@endsection

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="container">
    <h2>اضافة المبلغ</h2>

    <form method="POST" action="{{ route('caisse.store') }}">
        @csrf

        <input type="hidden" name="voyage_id" value="{{ $voyage_id }}">

        <div class="form-group">
            <label for="date">التاريخ</label>
            <input type="date" name="date" class="form-control" required value="<?php echo date('Y-m-d');?>">
        </div>

        <div class="form-group">
            <label for="montant">المبلغ</label>
            <input type="number" name="montant" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">اضافة المبلغ</button>
    </form>
</div>
        </div>
    </div>
</div>
@endsection

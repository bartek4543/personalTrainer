@extends('layouts.myLayout')

@section('main')
<h3>Dodawanie nowego wpisu</h3>
<form name="addProgressForm" onsubmit="addProgress(event, {{session('user_id')}})">
        <div class="form-group row">
        <label for="wzrost" class="col-md-2 mb-3 col-form-label font-weight-bold">Wzrost:</label>
        <div class="col-md-5"><input type="number" name="wzrost" class="form-control"/> 
        <div id="wzrost" class='invalid-feedback'></div></div></div>
            <div class="form-group row">
        <label for="waga" class="col-md-2 mb-3 col-form-label font-weight-bold">Waga:</label>
            <div class="col-md-5"><input type="number" name="waga" class="form-control"/> 
        <div id="waga" class='invalid-feedback'></div></div></div>
            <div class="form-group row">
        <label for="obwod_klatka" class="col-md-2 mb-3 col-form-label font-weight-bold">Obwód klatki piersiowej:</label>
            <div class="col-md-5"><input type="number" name="obwod_klatka" class="form-control"/> 
        <div id="obwod_klatka" class='invalid-feedback'></div></div></div>
            <div class="form-group row">
        <label for="obwod_biceps" class="col-md-2 mb-3 col-form-label font-weight-bold">Obwód bicepsa:</label>
            <div class="col-md-5"><input type="number" name="obwod_biceps" class="form-control"/> 
        <div id="obwod_biceps" class='invalid-feedback'></div></div></div>
            <div class="form-group row">
        <label for="data" class="col-md-2 mb-3 col-form-label font-weight-bold">Data:</label>
        <div class="col-md-5"><input type="date" name="data" class="form-control" required/> 
        <div id="data" class='invalid-feedback'></div></div></div>
        Wszystkie wartości podajemy w centymetrach</br>
        <input type="submit" class="btn btn-dark" value="Dodaj" />
</form>

@endsection

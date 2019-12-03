@extends('layouts.myLayout')

@section('main')
<h3>Edycja danych</h3>
<form name="editProfileForm" onsubmit="editProfile(event, {{session('user_id')}})">
    <div class="form-group row">
        <label for="imie" class="col-md-2 mb-3 col-form-label font-weight-bold">Imie:</label>
        <div class="col-md-5"><input type="text" name="imie" class="form-control" value="{{ $imie }} "/>
        <div id="imie" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="nazwisko" class="col-md-2 mb-3 col-form-label font-weight-bold">Nazwisko:</label>
        <div class="col-md-5"><input type="text" name="nazwisko" class="form-control" value="{{ $nazwisko }}"/> 
        <div id="nazwisko" class='invalid-feedback'></div> </div></div>
    <div class="form-group row">
        <label for="wiek" class="col-md-2 mb-3 col-form-label font-weight-bold">Wiek:</label>
        <div class="col-md-5"><input type="date" name="wiek" class="form-control" value="{{ $wiek }}"/> 
        <div id="wiek" class='invalid-feedback'></div></div></div>
            <input type="submit" class="btn btn-dark" value="Edytuj"/>
@endsection


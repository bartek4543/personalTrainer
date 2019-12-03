@extends('layouts.myLayout')

@section('main')
<h3>Rejestracja</h3>
<form name="registerForm" onsubmit="register(event)">
    <div class="form-group row">
        <label for="login" class="col-md-2 mb-3 col-form-label font-weight-bold">Login:</label>
            <div class="col-md-5"><input type="text" name="login" class="form-control" value="" required minlength="4" maxlength="20"/> 
        <div id="login" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="haslo" class="col-md-2 mb-3 col-form-label font-weight-bold">Hasło:</label>
        <div class="col-md-5"> <input type="password" name="haslo" class="form-control" value="" required minlength="6" maxlength="20"/> 
        <div id="haslo" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="email" class="col-md-2 mb-3 col-form-label font-weight-bold">E-mail:</label>
        <div class="col-md-5"> <input type="email" name="email" class="form-control" value="" required/> 
        <div id="email" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="imie" class="col-md-2 mb-3 col-form-label font-weight-bold">Imie:</label>
        <div class="col-md-5"><input type="text" name="imie" class="form-control" value=""/>
        <div id="imie" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="nazwisko" class="col-md-2 mb-3 col-form-label font-weight-bold">Nazwisko:</label>
        <div class="col-md-5"><input type="text" name="nazwisko" class="form-control" value=""/> 
        <div id="nazwisko" class='invalid-feedback'></div> </div></div>
    <div class="form-group row">
        <label for="wiek" class="col-md-2 mb-3 col-form-label font-weight-bold">Wiek:</label>
        <div class="col-md-5"><input type="date" name="wiek" class="form-control" value=""/> 
        <div id="wiek" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="status" class="col-md-2 mb-3 col-form-label font-weight-bold">Rola:</label>
       <div class="col-md-5"> <select class="custom-select" name="status">
        <option value="Podopieczny" selected="">Podopieczny</option>
        <option value="Trener">Trener</option>
           </select><div id="status" class='invalid-feedback'></div></div></div> 
        <input type="submit" class="btn btn-dark" value="Rejestracja"/>
        
 
    
</form>
Masz już konto? <a href="{{ route('loginPage') }}">Zaloguj się</a>
@endsection

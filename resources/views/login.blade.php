@extends('layouts.myLayout')

@section('main')
<h3>Logowanie</h3>
<form name="loginForm" onsubmit="logIn(event)">
    
        <div class="form-group row">
        <label for="login" class="col-md-2 mb-3 col-form-label font-weight-bold">Login:</label>
        <div class="col-md-5"><input type="text" name="login" class="form-control " value="" required minlength="4" maxlength="20"/> 
        </div></div>
         <div class="form-group row">
        <label for="haslo" class="col-md-2 mb-3 col-form-label font-weight-bold">Hasło:</label>
        <div class="col-md-5"> <input type="password" name="haslo" class="form-control" value="" required minlength="6" maxlength="20"/> 
    <div id="haslo" class='invalid-feedback'></div></div></div>
    <input type="submit" class="btn btn-dark" value="Logowanie"/>
</form>
Nie masz konta? <a href="{{ route('registerPage') }} ">Zarejestruj się</a>
@endsection

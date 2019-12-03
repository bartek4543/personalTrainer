@extends('layouts.myLayout')

@section('main')
<h3>Zmiana hasła</h3>
<form name="editPasswordForm" onsubmit="editPassword(event, {{session('user_id')}})">
        <div class="form-group row">
        <label for="stareHaslo" class="col-md-2 mb-3 col-form-label font-weight-bold">Obecne hasło:</label>
            <div class="col-md-5"><input type="password" name="stareHaslo" class="form-control" value="" required minlength="6" maxlength="20"/> 
        <div id="stareHaslo" class='invalid-feedback'></div></div></div>
    <div class="form-group row">
        <label for="haslo" class="col-md-2 mb-3 col-form-label font-weight-bold">Nowe hasło:</label>
        <div class="col-md-5"> <input type="password" name="haslo" class="form-control" value="" required minlength="6" maxlength="20"/> 
        <div id="haslo" class='invalid-feedback'></div></div></div>
                <input type="submit" class="btn btn-dark" value="Zmień hasło"/>
</form>
@endsection
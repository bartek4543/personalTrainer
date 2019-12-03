@extends('layouts/myLayout')

@section('main')
<h3>Dodawanie ćwiczeń</h3>
<form name="addExerciseForm" onsubmit="addExercise(event, {{session('user_id')}})">
        <div class="form-group row">
        <label for="nazwa" class="col-md-2 mb-3 col-form-label font-weight-bold">Nazwa:</label>
        <div class="col-md-5"><input type="text" name="nazwa" class="form-control" required/> 
        <div id="nazwa" class='invalid-feedback'></div></div></div>
            <div class="form-group row">
        <label for="opis" class="col-md-2 mb-3 col-form-label font-weight-bold">Opis:</label>
        <div class="col-md-5">
            <textarea name="opis" rows="4" cols="20" class='form-control' required>
            </textarea>
        <div id="opis" class='invalid-feedback'></div></div></div>
        <input type="submit" class="btn btn-dark" value="Dodaj" />
</form>
@endsection


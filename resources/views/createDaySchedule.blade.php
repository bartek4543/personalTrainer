@extends('layouts.myLayout')

@section('main')
<h3>Tworzenie planu dnia</h3>
<form name ="createScheduleForm" onsubmit="addSchedule(event, {{session('user_id')}}, {{$protege_id}})">
        <div class="form-group row">
        <label for="data" class="col-md-2 mb-3 col-form-label font-weight-bold">Data:</label>
        <div class="col-md-5"><input type="date" name="data" class="form-control"/></div></div>
    Wybierz dania: <div id="dania"></div> <button class='btn btn-link' onclick="getDishes(event, {{session('user_id')}})">Dodaj danie</button> </br>
   Wybierz ćwiczenia:<div id="cwiczenia"></div><button class='btn btn-link' onclick="getExercises(event, {{session('user_id')}})">Dodaj ćwiczenie</button> </br>
    <input type="submit" class="btn btn-dark" value="Dodaj">
</form>
@endsection


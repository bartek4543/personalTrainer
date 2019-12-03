@extends('layouts.myLayout')

@section('main')
<body onload="showExercises({{session('user_id')}})">
<h3>Twoje ćwiczenia</h3>
<a class="btn btn-dark" href="{{route('addExercise')}}">Dodaj ćwiczenie</a>

<div id="wymiary"></div>
    

@endsection

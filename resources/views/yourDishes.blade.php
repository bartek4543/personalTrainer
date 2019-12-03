@extends('layouts.myLayout')

@section('main')
<body onload="showDishes({{session('user_id')}})">
<h3>Twoje dania</h3>
<a class="btn btn-dark" href="{{route('addDish')}}">Dodaj danie</a>

<div id="wymiary"></div>
    

@endsection

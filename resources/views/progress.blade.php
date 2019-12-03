@extends('layouts.myLayout')

@section('main')
<body onload="showProgress({{session('user_id')}})">
<h3>Twoje postępy</h3>
<a class="btn btn-dark" href="{{route('addProgress')}}">Dodaj wpis</a>

<div id="wymiary"></div>
    

@endsection


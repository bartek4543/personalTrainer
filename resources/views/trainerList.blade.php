@extends('layouts/myLayout')

@section('main')
<h3>Trenerzy</h3>
<body onload="showTrainers('login', 'asc', {{session('user_id')}})">
    <input type="text" class='form-control' id="szukanie" onkeyup="showTrainers('login', 'asc', {{session('user_id')}})">
<table id='HeaderTable'>
    <tr><td><button class='btn btn-link' onclick="showTrainers('login', 'asc', {{session('user_id')}})">Login</button></td><td><button class='btn btn-link' onclick="showTrainers('imie', 'asc',{{session('user_id')}})">Imie</button></td><td><button class='btn btn-link'>Nazwisko</button></td>
        <td><button class='btn btn-link'>Wiek</button></td></tr>
</table>
<div id='trainers'></div>
@endsection


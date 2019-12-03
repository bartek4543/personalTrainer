@extends('layouts/myLayout')

@section('main')
<body onload='proteges({{session('user_id')}}, "tak")'>
<h3>Twoi podopieczni</h3>
<button class='btn btn-dark' onclick='proteges({{session('user_id')}}, "tak")'>Podopieczni</button> <button class='btn btn-dark' onclick='proteges({{session('user_id')}}, "nie")'>Prośby</button>
<table id='HeaderTable'>
    <tr><td><button class='btn btn-link' onclick="">Login</button></td><td><button class='btn btn-link' onclick="">Imie</button></td><td><button class='btn btn-link'>Nazwisko</button></td>
        <td><button class='btn btn-link'>Wiek</button></td></tr>
</table>
<div id='proteges'></div>

@endsection


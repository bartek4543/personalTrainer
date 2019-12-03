

@extends('layouts.myLayout')

@section('main')
<h3>Twoje dane</h3>
<table>
    <tr><td>Login:</td> <td class="font-weight-bold">{{ $login }}</td></tr> 
    <tr><td>E-mail:</td> <td class="font-weight-bold">{{ $email }} </td></tr> 
    <tr><td>Imie:</td> <td class="font-weight-bold">{{ $imie }} </td></tr> 
    <tr><td>Nazwisko:</td> <td class="font-weight-bold">{{ $nazwisko }} </td></tr> 
    <tr><td>Wiek:</td> <td class="font-weight-bold">{{ $wiek }} </td></tr> 
    <tr><td>Status:</td> <td class="font-weight-bold">{{ $status }} </td></tr> 
</table>
<a class="btn btn-dark" href=" {{ route('editProfile') }} ">Edytuj dane</a><a class="btn btn-dark" href="{{ route('editPassword') }}">Zmień hasło</a>
    

@endsection


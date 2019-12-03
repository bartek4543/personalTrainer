@extends('layouts.myLayout')

@section('main')
<h3>Wiadomości</h3>
@if (session('status') === 'Podopieczny')
    
    <body onload="getMessages({{session('user_id')}}, 0, 0)">
@else 
    <body onload="getConversations({{session('user_id')}})">
@endif
<div id="messageWindow">
    <div id="top"></div>
    <div id="messages"></div>
    <div id="bottom">
        <form id='wiadomosc'>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="tresc">
            <div class="input-group-append">
                <input type='submit' class="btn btn-outline-secondary" type="button" value='Wyślij'>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection


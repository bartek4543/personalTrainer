@extends('layouts.myLayout')
@section('main')
<body onload="schedules({{session('user_id')}})">
<h3>Twoje plany dni</h3>
<div id='plany'>
</div>
@endsection


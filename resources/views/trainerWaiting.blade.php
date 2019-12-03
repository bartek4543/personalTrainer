@extends('layouts/myLayout')

@section('main')
Twoja prośba oczekuje na akceptacje.</br>
<button class="btn btn-link" onclick='cancelRequest({{session('user_id')}}, 0)'>Anuluj prośbe</button>
@endsection


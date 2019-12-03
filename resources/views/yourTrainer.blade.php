@extends('layouts/myLayout')

@section('main')
<h3>Trenerzy</h3>
Posiadasz juz przypisanego trenera. <button class="btn btn-link" onclick="cancelRequest({{session('user_id')}}, 0)">Zrezygnuj</button>
@endsection


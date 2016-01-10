@extends('main')

@section('title')
Weekly Temps
@endsection

@section('content')
@if(isset($weeklystats))
<h1>Week of {{ $requestArray['date'] }}:</h1>
<div>{{ floor($weeklystats['avg']) }}&deg;F</div>
<div style="background-color:{{ $weeklystats['color']['hex'] }};color:#FFF;">{{ $weeklystats['color']['name'] }}</div>
@endif

@if(isset($error))
<div class="bg-danger">
{{ $error }}
</div>
@endif

@endsection

@section('error')
@endsection
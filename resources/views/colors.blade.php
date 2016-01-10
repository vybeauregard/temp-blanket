@extends('main')

@section('title')
Colors
@endsection

@section('content')
<h3>@yield('title')</h3>
<table class="table table-bordered table-striped">
    @foreach($tempRanges as $band)
    <tr>
        <!-- td>{{ $band['low'] }}</td>
        <td>{{ $band['high'] }}</td -->
        <td style="color:#FFF;background-color:{{ $band['color']['hex'] }}"><div>{{ $band['color']['name'] }}</div></td>
    </tr>
    @endforeach
</table>
@endsection
@extends('base')

@section('content')

<h1>Search Results</h1>
    @foreach($searchResults as $result)
        <div class="col-md-3">
            <a href="{{ URL::to('whatdata/' . $result['id']) }}">{{ $result['name'] }}</a>
            <p>ID: {{ $result['idnum'] }}</p>
        </div>
    @endforeach


@stop

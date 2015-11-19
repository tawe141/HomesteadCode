@extends('base')

@section('content')

<h1>Search Results</h1>
<h2>Multiple results found.</h2>
    @foreach($searchResults as $result)
        <div class="col-md-3">
            <a href="{{ URL::to('whatdata/author/' . $result['name']) }}">User: {{ $result['name'] }}</a>
        </div>
    @endforeach


@stop

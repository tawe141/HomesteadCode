@extends('base')

@section('content')

<h1>Search Results</h1>
<h3>{{ $searchCount }} results found.</h3>
@yield('results')


@stop

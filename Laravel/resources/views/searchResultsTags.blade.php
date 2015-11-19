@extends('search_base')

@section('results')


@foreach($searchResults as $result)
    <div class="col-md-3">
        <a href="{{ URL::to('whatdata/tags/' . $result->name) }}">Tag: {{ $result->name }}</a>
        <p>{{ $result['count'] }} posts with this tag.</p>
    </div>
@endforeach


@stop

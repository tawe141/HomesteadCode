@extends('base')

@section('content')
    <h2>This entry was deleted.</h2>
    <p>Deleted at: {{ $deletedAt }}</p>
    <p>Restore?</p>
    <a href="{{ URL::to('/restoreinfo/' . $id) }}" class="btn btn-default">Yes</a>
    <a href="{{ URL::previous() }}" class="btn btn-default">No</a>
@stop

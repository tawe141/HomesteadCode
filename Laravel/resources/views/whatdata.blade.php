@extends('base')

@section('content')
    <h1>Data</h1>
    @if(isset($author))
    <h2>From author: {{ $author }}</h2>
    @elseif(isset($tag))
    <h2>Tag: {{ $tag }}</h2>
    @endif
    <div id="sortable">
        @foreach($data as $datum)
            <div class="col-md-3">
                <h2><a href="{{ URL::to('whatdata/' . $datum->id) }}">Name: {{ $datum->name }}</a></h2>
                <p> ID: {{ $datum->idnum }}</p>
                <p> Job title: {{ $datum->jobtitle }}</p>
                <a class="btn btn-primary" href="{{ URL::to('/editinfo/' . $datum->id)}}">Edit</a>
                <a class="btn btn-danger" href="{{ URL::to('/deleteinfo/' . $datum->id . '/confirm')}}">Delete</a>
            </div>
        @endforeach
    </div>
@stop

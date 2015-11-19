@extends('base')

@section('content')
    <h1>Data</h1>
        <div class="col-md-3">
            <h2>Name: {{ $data->name }}</h2>
            <p> ID: {{ $data->idnum }}</p>
            <p> Job title: {{ $data->jobtitle }}</p>
            <p> Author: {{ $author }}</p>
            <p> Tags:</p>
            <ul>
                @foreach($tags as $tag)
                    <li>{{ $tag }}</li>
                @endforeach
        </div>
        <div class="col-md-3" id="editdelete">
            <a class="btn btn-primary" href="{{ URL::to('/editinfo/' . $data->id)}}">Edit</a>
            <a class="btn btn-danger" href="{{ URL::to('/deleteinfo/' . $data->id . '/confirm')}}">Delete</a>
        </div>
        @if($delete == true)
            <div class="col-md-3 alert alert-danger">
                <p>Are you sure you want to delete this?</p>
                <a href="{{ URL::to('/deleteinfo/' . $data->id) }}" class="btn btn-danger">Yes</a>
                <a href="{{ URL::to('/whatdata/') }}" class="btn btn-default">No</a>
            </div>
            <script>
                $("#editdelete").hide()
            </script>
        @endif

@stop

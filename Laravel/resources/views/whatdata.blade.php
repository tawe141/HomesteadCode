@extends('base')

@section('content')

    <h1>Data</h1>
    @if(isset($author))
    <h2>From author: {{ $author }}</h2>
    @elseif(isset($tag))
    <h2>Tag: {{ $tag }}</h2>
    @endif
    <style>
        .valign {
            display:inline-block;
            vertical-align:middle;
            text-align: center;
            float: none;
            position: relative;
            top: 50%;
        }
        .center {
            margin-top: 1em;
            padding-top: 1em;
            padding-bottom: 1em;
        }
        .center-block {
            margin: auto;
            width: 30%;
            padding: 10px;
        }
        .col-centered {
            float: none;
            margin: 0 auto;
        }
        .grayed {
            color: #DDDDDD;
        }
    </style>
    <div id="sortable" class="container">
        @foreach($data as $datum)
            <div class="col-md-3">
                <h2><a href="{{ URL::to('whatdata/' . $datum->id) }}">Name: {{ $datum->name }}</a></h2>
                <p> ID: {{ $datum->idnum }}</p>
                <p> Job title: {{ $datum->jobtitle }}</p>
                <a class="btn btn-primary" href="{{ URL::to('/editinfo/' . $datum->id)}}">Edit</a>
                <a class="btn btn-danger" href="{{ URL::to('/deleteinfo/' . $datum->id . '/confirm')}}">Delete</a>
            </div>
        @endforeach
        <div class="col-md-3 center grayed" style="outline: #DDDDDD dotted thick" data-toggle="modal" data-target="#newStore">
            <i class="glyphicon glyphicon-plus center-block" style="font-size: 5em"></i>
            <h3 class="text-center">Click to add a new entry.</h3>
        </div>
        <!-- Modal -->
        <div id="newStore" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal Content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Data Store</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

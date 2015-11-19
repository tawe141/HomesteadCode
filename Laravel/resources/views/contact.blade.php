@extends('base')

@section('content')
        <div class="container">
            <div class="content">
                <div class="title">About me</div>
                <p>{{ $name }}</p>
                <p>Email: {{ $email }}</p>
                <p>Phone: {{ $phone }}</p>
            </div>
        </div>
@stop

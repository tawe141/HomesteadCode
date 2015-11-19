@extends('base')

@section('content')
<h3>There were errors on your form.</h3>
<ul>
@foreach($errors as $error)
    <li>Error: {{ $error }}</li>
@endforeach
</ul>
@stop

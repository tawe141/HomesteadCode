@extends('base')

@section('content')

<h1>Login</h1>
<form method="POST" action="/auth/login" class="form-horizontal" role="form">
    {!! csrf_field() !!}
<!--
    <div class="form-group">
        {!! Form::label('email', 'Email: ', array('class' => 'control-group col-sm-1')) !!}
        <input type="email" name="email" value="{{ old('email') }}" class="form-control col-sm-4">
    </div>

    <div class="form-group">
        Password
        <input type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div class="form-group">
        <button type="submit">Login</button>
    </div>
-->
    <div class="form-group">
        {!! Form::label('email', 'Email: ', array('class' => 'control-group col-sm-1')) !!}
        <div class="col-sm-4">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password: ', array('class' => 'control-group col-sm-1')) !!}
        <div class="col-sm-4">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::checkbox('rememberme') !!}
        {!! Form::label('clickmelabel', 'Remember Me') !!}
        {!! Form::submit() !!}
    </div>
    <br>
</form>
@stop

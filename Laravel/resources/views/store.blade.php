@extends('base')

@section('content')

    @if(isset($data))
    <h1>Update Data</h1>
    {!! Form::model($data, array('class' => 'form-horizontal', 'role' => 'form', 'url' => 'updateinfo/' . $id)) !!}
    @else
    <h1>New Data</h1>
    {!! Form::open(array('class' => 'form-horizontal', 'role' => 'form', 'url' => 'postinfo')) !!}
    @endif
    </ul>
        <div class="form-group">
            {!! Form::label('name', 'Name: ', array('class' => 'control-group col-sm-1')) !!}
            <div class="col-sm-4">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('idnum', 'ID Number: ', array('class' => 'control-group col-sm-1')) !!}
            <div class="col-sm-4">
                {!! Form::text('idnum', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('jobtitle', 'Job Title: ', array('class' => 'control-group col-sm-1')) !!}
            <div class="col-sm-4">
                {!! Form::text('jobtitle', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('tags', 'Tags: ', array('class' => 'control-group col-sm-1')) !!}
            <div class="col-sm-4">
                {!! Form::select('tags[]', $tags, $dataTags, ['id' => 'tagSelectBox', 'class' => 'form-control', 'multiple']) !!}
            </div>
            {!! Form::label('inputtags', 'Input Tags:', array('class' => 'control-group col-sm-1')) !!}
            <div class = 'col-sm-4'>
                <p>Type in tags here. Tags not found in the database will be added automatically. Separate using spaces.</p>
                {!! Form::text('inputtags', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!! Form::checkbox('clickme') !!}
            {!! Form::label('clickmelabel', 'CLICK MEEEE!!') !!}
            {!! Form::submit() !!}
        </div>
        <br>



    {!! Form::close() !!}
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        $('#tagSelectBox').select2();
    </script>
@stop

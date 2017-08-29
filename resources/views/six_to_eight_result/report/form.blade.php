@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><center>Class <code>VI-VIII</code> Result Print Form</center></div>

                <div class="panel-body">
                    <div class="col-md-12">
                    {!! Form::open(['url' => 'six-to-eight-result/class-wise-result-show', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
                    <div class="required form-group" {{ $errors->has('level_id') ? 'has-error' : '' }}>
                        {!! Form::label('level_id', 'Select Class', ['class' => 'control-label col-sm-3']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('level_id', $classList, null, ['class' => 'form-control', 'placeholder' => 'Select Class', 'id' => '', 'required']) !!}
                            <span class="help-block text-danger">
                                {{ $errors->first('level_id') }}
                            </span>
                        </div>
                    </div>
                    <div class="required form-group" {{ $errors->has('year_id') ? 'has-error' : '' }}>
                        {!! Form::label('year_id', 'Select Year', ['class' => 'control-label col-sm-3']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('year_id', $yearList, null, ['class' => 'form-control', 'placeholder' => 'Select Year', 'required']) !!}
                            <span class="help-block text-danger">
                                {{ $errors->first('year_id') }}
                            </span>
                        </div>
                    </div>
                    <div class="required form-group" {{ $errors->has('term_id') ? 'has-error' : '' }}>
                        {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('term_id', $termList, null, ['class' => 'form-control', 'placeholder' => 'Select Term', 'required']) !!}
                            <span class="help-block text-danger">
                                {{ $errors->first('term_id') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-0">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')

{!! Form::open(['method' => 'POST', 'route' => ['savefeedback']]) !!}

    <div class="card card-primary">
        <div class="card-header">
            @lang('global.app_create')
        </div>
        
        <div class="card-body">
    
                <div class="form-group-lg">
                    {!! Form::label('feedback', 'Type your feedback here*', ['class' => 'control-label']) !!}
                    {!! Form::text('feedback', old('feedback'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        
                </div>

                <div class="form-group">
                           {!! Form::label('employee','Employee', ['class' => 'control-label']) !!}
                           {!! Form::select('employee', $employees, old('employee'), ['class' => 'form-control select2']) !!}
                </div>
                        
        </div>
    </div>

    {!! Form::submit(trans('global.app_send'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}


@endsection
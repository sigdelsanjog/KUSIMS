@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.program.title')</h3>
    
    {!! Form::model($program, ['method' => 'PUT', 'route' => ['setting.programs.update', $program->id]]) !!}

    <div class="card card-default">
        <div class="card-header">
            @lang('global.app_edit')
        </div>
        
        <div class="card-body">
                <div class="form-group">
                    {!! Form::label('name', trans('global.program.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('global.program.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
        </div>
            
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

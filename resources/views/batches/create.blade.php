@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.batch.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['setting.batches.store']]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">@lang('global.app_create')</h3>
                </div>
            
                <div class="card-body">
                    
                        <div class="form-group">
                            {!! Form::label('year', trans('global.batch.fields.year').'*', ['class' => 'control-label']) !!}
                            {!! Form::number('year', old('year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('year'))
                                <p class="help-block">
                                    {{ $errors->first('year') }}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', trans('global.batch.fields.description').'', ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '','rows'=>'2']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                        </div>
                </div>
                
            </div>
        </div>
    </div>
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

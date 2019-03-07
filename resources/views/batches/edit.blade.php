@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.batch.title')</h3>
    
    {!! Form::model($batch, ['method' => 'PUT', 'route' => ['setting.batches.update', $batch->id]]) !!}

     <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_edit')</h3>
            
        </div>

          <div class="box-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year', trans('global.batch.fields.year').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('year', old('year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year'))
                        <p class="help-block">
                            {{ $errors->first('year') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

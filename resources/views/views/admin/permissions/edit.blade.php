@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.permissions.title')</h3>
    
    {!! Form::model($permission, ['method' => 'PUT', 'route' => ['admin.permissions.update', $permission->id]]) !!}

    <div class="card card-info">
        <div class="card-header">
            @lang('global.app_create')
        </div>
        
        <div class="card-body">
                <div class="form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>           
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


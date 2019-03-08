@extends('layouts.app')

@section('content')
   <h3 class="page-title">@lang('global.jobtype.title')</h3>
   {!! Form::open(['method' => 'POST', 'route' => ['setting.jobtypes.store']]) !!}

   <div class="card card-default">
       <div class="card-header">
           @lang('global.app_create')
       </div>

       <div class="card-body">
               <div class="form-group">
                   {!! Form::label('name', trans('global.jobtype.fields.name').'*', ['class' => 'control-label']) !!}
                   {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                   <p class="help-block"></p>
                   @if($errors->has('name'))
                       <p class="help-block">
                           {{ $errors->first('name') }}
                       </p>
                   @endif
               </div>
               <div class="form-group">
                   {!! Form::label('description', trans('global.jobtype.fields.description').'', ['class' => 'control-label']) !!}
                   {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                   <p class="help-block"></p>
                   @if($errors->has('description'))
                       <p class="help-block">
                           {{ $errors->first('description') }}
                       </p>
                   @endif
               </div>
       </div>
   </div>

   {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
   {!! Form::close() !!}
@stop
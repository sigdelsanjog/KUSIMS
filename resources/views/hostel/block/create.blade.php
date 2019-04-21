@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelblock.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['hostel.block.store']]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">@lang('global.app_create')</h3>
                </div>
            
                <div class="card-body">
                    
                        <div class="form-group">
                        {!! Form::label('name', trans('global.hostelblock.fields.name').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('incharge', trans('global.hostelblock.fields.incharge').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('incharge', old('incharge'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('incharge'))
                                <p class="help-block">
                                    {{ $errors->first('incharge') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('contact', trans('global.hostelblock.fields.contact').'', ['class' => 'control-label']) !!}
                            {!! Form::text('contact', old('contact'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('contact'))
                                <p class="help-block">
                                    {{ $errors->first('contact') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('location', trans('global.hostelblock.fields.location').'', ['class' => 'control-label']) !!}
                            {!! Form::text('location', old('location'), ['class' => 'form-control ', 'placeholder' => '','rows'=>'2']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('location'))
                                <p class="help-block">
                                    {{ $errors->first('location') }}
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

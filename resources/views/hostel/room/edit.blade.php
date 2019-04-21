@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelroom.title')</h3>
    {!! Form::model($hostelroom, ['method' => 'PUT', 'route' => ['hostel.room.update', $hostelroom->id]]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">@lang('global.app_edit')</h3>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('block_id', trans('global.hostelroom.fields.block').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('block_id', $blocks, old('block_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('block_id'))
                                <p class="help-block">
                                    {{ $errors->first('block_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('room', trans('global.hostelroom.fields.room').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('room', old('room'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('room'))
                                <p class="help-block">
                                    {{ $errors->first('room') }}
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

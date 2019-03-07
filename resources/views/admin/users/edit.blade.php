@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

    <div class="card card-default">
        <div class="card-header">
            @lang('global.app_edit')
        </div>

        <div class="card-body">
    
    <div class="form-group">
        {!! Form::label('first_name', 'First Name*', ['class' => 'control-label']) !!}
        {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('first_name'))
            <p class="help-block">
                {{ $errors->first('first_name') }}
            </p>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name*', ['class' => 'control-label']) !!}
        {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('last_name'))
            <p class="help-block">
                {{ $errors->first('last_name') }}
            </p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('email'))
            <p class="help-block">
                {{ $errors->first('email') }}
            </p>
        @endif
    </div>


    <div class="form-group">
        {!! Form::label('password', 'Password*', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('password'))
            <p class="help-block">
                {{ $errors->first('password') }}
            </p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('roles', 'Roles*', ['class' => 'control-label']) !!}
        {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('roles'))
            <p class="help-block">
                {{ $errors->first('roles') }}
            </p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('user_type', trans('global.users.fields.user-type').'*', ['class' => 'control-label']) !!}
        {!! Form::select('user_type', $enum_user_type, old('user_type'), ['class' => 'form-control select2', 'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('user_type'))
            <p class="help-block">
                {{ $errors->first('user_type') }}
            </p>
        @endif
    </div>
</div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


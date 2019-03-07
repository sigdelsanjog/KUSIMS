@extends('layouts.app')

@section('content')
    <h3 class="page-title">School</h3>

    {!! Form::open(['method' => 'POST', 'route' => ['setting.school.store']]) !!}

    <div class="card card-primary">
        <div class="card-header">
            Create
        </div>

        <div class="card-body">
           
                <div class="form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
       
                <div class="form-group">
                    {!! Form::label('address', 'Address*', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
                   
           
                <div class="form-group">
                    {!! Form::label('phone', 'Phone*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
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
                    {!! Form::label('contact_person', 'Contact Person*', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_person', old('contact_person'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contact_person'))
                        <p class="help-block">
                            {{ $errors->first('contact_person') }}
                        </p>
                    @endif
                </div>
           
                <div class="form-group">
                    {!! Form::label('contact_person_phone', 'Contact Person Phone*', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_person_phone', old('contact_person_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contact_person_phone'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_phone') }}
                        </p>
                    @endif
                </div>
           
            
                <div class="form-group">
                    {!! Form::label('status', 'Status*', ['class' => 'control-label']) !!}
                    {!! Form::select('status', ['1' => 'Active', '2' => 'In Active'], null, ['class' => 'form-control','placeholder' => '---Status---']); !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
      
           
                <div class="form-group">
                    {!! Form::label('notes', 'Notes*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('notes', old('notes'), ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => '','rows' => 2, 'cols' => 40]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('notes'))
                        <p class="help-block">
                            {{ $errors->first('notes') }}
                        </p>
                    @endif
                </div>
           
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


@extends('layouts.app')
    
@section('content')

    <h3 class="page-title">@lang('global.employee.title')</h3>
    
    {!! Form::model($employee, ['method' => 'PUT', 'route' => ['setting.employees.update', $employee->id]]) !!}

    <div class="row">
        <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header with-border">
                        Basic Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                {!! Form::label('first_name', trans('global.employee.fields.first-name').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('first_name'))
                                    <p class="help-block">
                                        {{ $errors->first('first_name') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('middle_name', trans('global.employee.fields.middle-name').'', ['class' => 'control-label']) !!}
                                {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('middle_name'))
                                    <p class="help-block">
                                        {{ $errors->first('middle_name') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('last_name', trans('global.employee.fields.last-name').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('last_name'))
                                    <p class="help-block">
                                        {{ $errors->first('last_name') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                    {!! Form::label('dept_id', trans('global.employee.fields.dept').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('dept_id', $depts, old('dept_id'), ['class' => 'form-control select2']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('dept_id'))
                                        <p class="help-block">
                                            {{ $errors->first('dept_id') }}
                                        </p>
                                    @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('phone', trans('global.employee.fields.phone').'', ['class' => 'control-label']) !!}
                                {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('phone'))
                                    <p class="help-block">
                                        {{ $errors->first('phone') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('email', trans('global.employee.fields.email').'', ['class' => 'control-label']) !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('email'))
                                    <p class="help-block">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('address', trans('global.employee.fields.address').'', ['class' => 'control-label']) !!}
                                {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('address'))
                                    <p class="help-block">
                                        {{ $errors->first('address') }}
                                    </p>
                                @endif
                        </div>
                        <div class="form-group">
                                {!! Form::label('qualification', trans('global.employee.fields.qualification').'', ['class' => 'control-label']) !!}
                                {!! Form::text('qualification', old('qualification'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('qualification'))
                                    <p class="help-block">
                                        {{ $errors->first('qualification') }}
                                    </p>
                                @endif
                        </div>
                    </div>

                </div>
        </div>
        <div class="col-md-7">
            <div class="card card-primary">
                <div class="card-header">
                   Employee Type
                </div>
                <div class="card-body">
                 
                    <course item-list="{{ json_encode($teacherCourses) }}" 
                    teacher-id="{{$employee->id}}" 
                    course="{{ $courses }}" batch="{{$batches}}" dept="{{$deptsComp}}" program="{{$programs}}" job_id="{{$employee->job_id}}" job="{{$jobs}}"></course>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


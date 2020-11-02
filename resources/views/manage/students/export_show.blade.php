@extends('layouts.app')

@section('content')
  
   {!! Form::open(['method' => 'POST', 'route' => ['manage.students.export']]) !!}

   <div class="card card-default mt-2">
       <div class="card-header">
           Export Student
       </div>
       <div class="card-body">
            <div class="form-group">
                {!! Form::label('dept_id',"Department", ['class' => 'control-label']) !!}
                {!! Form::select('dept_id', $depts, old('dept_id'), ['class' => 'form-control select2','required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('dept_id'))
                    <p class="help-block">
                        {{ $errors->first('dept_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('batch_id', "Batch", ['class' => 'control-label']) !!}
                {!! Form::select('batch_id', $batches, old('batch_id'), ['class' => 'form-control select2','required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('batch_id'))
                    <p class="help-block">
                        {{ $errors->first('batch_id') }}
                    </p>
                @endif
            </div> 
            <div class="form-group">
                {!! Form::label('program_id', "Program", ['class' => 'control-label']) !!}
                {!! Form::select('program_id', $programs, old('program_id'), ['class' => 'form-control select2','required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('program_id'))
                    <p class="help-block">
                        {{ $errors->first('program_id') }}
                    </p>
                @endif
            </div>
            <br>
            {!! Form::submit("Export Student", ['class' => 'btn btn-success']) !!}
            <a href="{{ route('manage.students.export_all') }}" class="btn btn-danger">Export All Student</a>
       </div>
   </div>

  
   {!! Form::close() !!}
@stop
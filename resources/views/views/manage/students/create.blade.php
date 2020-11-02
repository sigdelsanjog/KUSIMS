@extends('layouts.app')
@section('content')
<h3 class="page-title">@lang('global.student.title')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['manage.students.store']]) !!}

<div class="row">
   <div class="col-md-12">
      <ul class="nav nav-tabs" role="tablist">
         <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Information</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Academic Qualification:</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Messages</a>
         </li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active show" id="home" role="tabpanel">
            <div class="row">
               <div class="col-md-8">
                  <div class="card card-accent-info">
                     <div class="card-header">
                        Program
                     </div>
                     <div class="card-body">
                        <div class="form-group">
                           {!! Form::label('dept_id','Department', ['class' => 'control-label']) !!}
                           {!! Form::select('dept_id', $depts, old('dept_id'), ['class' => 'form-control select2']) !!}
                           <p class="help-block"></p>
                           @if($errors->has('batch_id'))
                           <p class="help-block">
                              {{ $errors->first('dept_id') }}
                           </p>
                           @endif
                        </div>
                        <div class="form-group">
                           {!! Form::label('batch_id', trans('global.student.fields.batch').'', ['class' => 'control-label']) !!}
                           {!! Form::select('batch_id', $batches, old('batch_id'), ['class' => 'form-control select2']) !!}
                           <p class="help-block"></p>
                           @if($errors->has('batch_id'))
                           <p class="help-block">
                              {{ $errors->first('batch_id') }}
                           </p>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        Basic Infromation
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="form-group col-md-4">
                              {!! Form::label('first_name', trans('global.student.fields.first-name').'*', ['class' => 'control-label']) !!}
                              {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('first_name'))
                              <p class="help-block">
                                 {{ $errors->first('first_name') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('middle_name', trans('global.student.fields.middle-name').'', ['class' => 'control-label']) !!}
                              {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('middle_name'))
                              <p class="help-block">
                                 {{ $errors->first('middle_name') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('last_name', trans('global.student.fields.last-name').'*', ['class' => 'control-label']) !!}
                              {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('last_name'))
                              <p class="help-block">
                                 {{ $errors->first('last_name') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('gender', trans('global.student.fields.gender').'*', ['class' => 'control-label']) !!}
                              {!! Form::select('gender', $enum_gender, old('gender'), ['class' => 'form-control select2', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('gender'))
                              <p class="help-block">
                                 {{ $errors->first('gender') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('date_of_birth', trans('global.student.fields.date-of-birth').'*', ['class' => 'control-label']) !!}
                              {!! Form::date('date_of_birth', old('date_of_birth'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('date_of_birth'))
                              <p class="help-block">
                                 {{ $errors->first('date_of_birth') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('nationality', trans('global.student.fields.nationality').'*', ['class' => 'control-label']) !!}
                              {!! Form::text('nationality', old('nationality'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('nationality'))
                              <p class="help-block">
                                 {{ $errors->first('nationality') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('email', trans('global.student.fields.email').'*', ['class' => 'control-label']) !!}
                              {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('email'))
                              <p class="help-block">
                                 {{ $errors->first('email') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group  col-md-4">
                              {!! Form::label('phone', trans('global.student.fields.phone').'', ['class' => 'control-label']) !!}
                              {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('phone'))
                              <p class="help-block">
                                 {{ $errors->first('phone') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group  col-md-4">
                              {!! Form::label('mobile_phone', trans('global.student.fields.mobile-phone').'*', ['class' => 'control-label']) !!}
                              {!! Form::text('mobile_phone', old('mobile_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('mobile_phone'))
                              <p class="help-block">
                                 {{ $errors->first('mobile_phone') }}
                              </p>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        Guardian Information
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="form-group col-md-3">
                              {!! Form::label('guardian_name', 'Name', ['class' => 'control-label']) !!}
                              {!! Form::text('guardian_name', old('guardian_name'), ['class' => 'form-control', 'placeholder' => 'Guardian Name']) !!}
                           </div>
                           <div class="form-group col-md-3">
                              {!! Form::label('guardian_relation','Relation', ['class' => 'control-label']) !!}
                              {!! Form::text('guardian_relation', old('guardian_relation'), ['class' => 'form-control', 'placeholder' => 'Relation']) !!}
                           </div>
                           <div class="form-group col-md-3">
                              {!! Form::label('guardian_contact','Contact', ['class' => 'control-label']) !!}
                              {!! Form::text('guardian_contact', old('guardian_contact'), ['class' => 'form-control', 'placeholder' => 'Contact']) !!}
                           </div>
                           <div class="form-group col-md-3">
                              {!! Form::label('guardian_occupation','Occupation', ['class' => 'control-label']) !!}
                              {!! Form::text('guardian_occupation', old('guardian_occupation'), ['class' => 'form-control', 'placeholder' => 'Occupation']) !!}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card">
                     <div class="card-header">
                        Citizenship
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="form-group col-md-3">
                              {!! Form::label('citizenship_no', trans('global.student.fields.citizenship-no').'', ['class' => 'control-label']) !!}
                              {!! Form::text('citizenship_no', old('citizenship_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('citizenship_no'))
                              <p class="help-block">
                                 {{ $errors->first('citizenship_no') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-4">
                              {!! Form::label('citizenship_issue_place', trans('global.student.fields.citizenship-issue-place').'', ['class' => 'control-label']) !!}
                              {!! Form::text('citizenship_issue_place', old('citizenship_issue_place'), ['class' => 'form-control', 'placeholder' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('citizenship_issue_place'))
                              <p class="help-block">
                                 {{ $errors->first('citizenship_issue_place') }}
                              </p>
                              @endif
                           </div>
                           <div class="form-group col-md-5">
                              {!! Form::label('citizenship_issue_date', trans('global.student.fields.citizenship-issue-date').'', ['class' => 'control-label']) !!}
                              {!! Form::date('citizenship_issue_date', old('citizenship_issue_date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('citizenship_issue_date'))
                              <p class="help-block">
                                 {{ $errors->first('citizenship_issue_date') }}
                              </p>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-2">
                  <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="profile" role="tabpanel">

         </div>
         <div class="tab-pane" id="messages" role="tabpanel">
         </div>
      </div>
   </div>
</div>
{!! Form::close() !!}
@stop
@section('javascript')
@parent

<script>

   $(function(){

       moment.updateLocale('{{ App::getLocale() }}', {
           week: { dow: 1 } // Monday is the first day of the week
       });
       
       $('.date').datetimepicker({
           format: "{{ config('app.date_format_moment') }}",
           locale: "{{ App::getLocale() }}",
       });
       
   });
</script>
@stop
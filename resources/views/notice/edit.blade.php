@extends('layouts.app')

@section('content')
   <h3 class="page-title">Notice</h3>
   {!! Form::model($notice, ['method' => 'PUT', 'route' => ['notice.update', $notice->id]]) !!}
   <div class="card card-default">
       <div class="card-header">
           @lang('global.app_create')
       </div>

       <div class="card-body">
               <div class="form-group">
                   {!! Form::label('title', trans('global.notice.fields.title').'*', ['class' => 'control-label']) !!}
                   {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                   <p class="help-block"></p>
                   @if($errors->has('title'))
                       <p class="help-block">
                           {{ $errors->first('title') }}
                       </p>
                   @endif
               </div>
               <div class="form-group">
                    
                    {!! Form::label('from_date', trans('global.notice.fields.from-date').'*', ['class' => 'control-label']) !!}
              
                    <div class="input-group date" id="from_date" data-target-input="nearest">
                        <input id="from_date" name="from_date" type="text" value="{{ $notice->from_date }}" class="form-control datetimepicker-input" data-target="#from_date"/>
                        <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <p class="help-block"></p>
                        @if($errors->has('from_date'))
                            <p class="help-block">
                                {{ $errors->first('from_date') }}
                            </p>
                        @endif
                 
                </div>
                <div class="form-group">
                    {!! Form::label('to_date', trans('global.notice.fields.to-date').'*', ['class' => 'control-label']) !!}
                    <div class="input-group date" id="to_date" data-target-input="nearest">
                        <input id="to_date" name="to_date" value="{{ $notice->to_date }}" type="text" class="form-control datetimepicker-input" data-target="#to_date"/>
                        <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('from_date'))
                        <p class="help-block">
                            {{ $errors->first('from_date') }}
                        </p>
                    @endif
                </div>  
               <div class="form-group">
                    {!! Form::label('user_type', trans('global.notice.fields.user-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_type', $enum_user_type, old('user_type'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_type'))
                        <p class="help-block">
                            {{ $errors->first('user_type') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                   {!! Form::label('description', trans('global.notice.fields.description').'', ['class' => 'control-label']) !!}
                   {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => '','rows' => 2, 'cols' => 40]) !!}
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
@section('javascript')
    @parent
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('#from_date').datetimepicker({
                minDate:moment(),
                format: 'L',
                keepOpen: false,
            });

            $('#to_date').datetimepicker({
                minDate:moment(),
                format: "L",
                keepOpen: false,
            });
            $('#from_date').on('change.datetimepicker', function(e) {
                $('#to_date').datetimepicker('minDate',  moment(e.date).add(1, 'days') )
            });


            
            
        });
    </script>
            
@stop

<style>
 .bootstrap-datetimepicker-widget{
     position:relative;
 }
</style>
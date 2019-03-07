@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.jobtype.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.jobtype.fields.name')</th>
                            <td field-key='name'>{{ $jobtype->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobtype.fields.description')</th>
                            <td field-key='description'>{{ $jobtype->description }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#employee" aria-controls="employee" role="tab" data-toggle="tab">Employee</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="employee">
<table class="table table-bordered table-striped {{ count($employees) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.employee.fields.first-name')</th>
                        <th>@lang('global.employee.fields.middle-name')</th>
                        <th>@lang('global.employee.fields.last-name')</th>
                        <th>@lang('global.employee.fields.job')</th>
                        <th>@lang('global.employee.fields.phone-number')</th>
                        <th>@lang('global.employee.fields.email-address')</th>
                        <th>@lang('global.employee.fields.address')</th>
                        <th>@lang('global.employee.fields.dept')</th>
                        <th>@lang('global.employee.fields.qualification')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($employees) > 0)
            @foreach ($employees as $employee)
                <tr data-entry-id="{{ $employee->id }}">
                    <td field-key='first_name'>{{ $employee->first_name }}</td>
                                <td field-key='middle_name'>{{ $employee->middle_name }}</td>
                                <td field-key='last_name'>{{ $employee->last_name }}</td>
                                <td field-key='job'>{{ $employee->job->name ?? '' }}</td>
                                <td field-key='phone_number'>{{ $employee->phone_number }}</td>
                                <td field-key='email_address'>{{ $employee->email_address }}</td>
                                <td field-key='address'>{{ $employee->address }}</td>
                                <td field-key='dept'>{{ $employee->dept->name ?? '' }}</td>
                                <td field-key='qualification'>{{ $employee->qualification }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('employee_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['setting.employees.restore', $employee->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('employee_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['setting.employees.perma_del', $employee->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('employee_view')
                                    <a href="{{ route('setting.employees.show',[$employee->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('employee_edit')
                                    <a href="{{ route('setting.employees.edit',[$employee->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('employee_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['setting.employees.destroy', $employee->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('setting.jobtypes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



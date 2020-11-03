@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.employee.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.employee.fields.first-name')</th>
                            <td field-key='first_name'>{{ $employee->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.middle-name')</th>
                            <td field-key='middle_name'>{{ $employee->middle_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.last-name')</th>
                            <td field-key='last_name'>{{ $employee->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.job')</th>
                            <td field-key='job'>{{ $employee->job->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.phone-number')</th>
                            <td field-key='phone_number'>{{ $employee->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.email-address')</th>
                            <td field-key='email_address'>{{ $employee->email_address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.address')</th>
                            <td field-key='address'>{{ $employee->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.dept')</th>
                            <td field-key='dept'>{{ $employee->dept->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.employee.fields.qualification')</th>
                            <td field-key='qualification'>{{ $employee->qualification }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('setting.employees.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



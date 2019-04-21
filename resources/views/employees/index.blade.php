@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.employee.title')</h3>
    @can('employee_create')
    <p>
        <a href="{{ route('setting.employees.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    @can('employee_delete')
        <ul class="list-inline">
            <li><a href="{{ route('setting.employees.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li>
            <li><a href="{{ route('setting.employees.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    
    @endcan

    <div class="card">
    <div class="card-header">@lang('global.app_list')</div>
      <div class="card-body table-responsive">
      <table id="example" class="table table-bordered table-striped @can('employee_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('employee_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.employee.fields.first-name')</th>
                        <th>@lang('global.employee.fields.middle-name')</th>
                        <th>@lang('global.employee.fields.last-name')</th>
                        <th>@lang('global.employee.fields.job')</th>
                        <th>@lang('global.employee.fields.phone')</th>
                        <th>@lang('global.employee.fields.email')</th>
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
                                @can('employee_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='first_name'>{{ $employee->first_name }}</td>
                                <td field-key='middle_name'>{{ $employee->middle_name }}</td>
                                <td field-key='last_name'>{{ $employee->last_name }}</td>
                                <td field-key='job'>{{ $employee->job->name ?? '' }}</td>
                                <td field-key='phone_number'>{{ $employee->phone }}</td>
                                <td field-key='email_address'>{{ $employee->email }}</td>
                                <td field-key='address'>{{ $employee->address }}</td>
                                <td field-key='dept'>{{ $employee->department->name ?? '' }}</td>
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
@stop

@section('javascript') 
    <script>
        @can('employee_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('setting.employees.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function() {
	            $('#example').DataTable();
            } );
    </script>
@endsection
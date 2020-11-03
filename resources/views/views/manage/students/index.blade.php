@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.student.title')</h3>
    @can('student_create')
    <p>
        <a href="{{ route('manage.students.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

        <a href="{{ route('manage.students.upload') }}" class="btn btn-danger">Upload Student</a>
    </p>
    @endcan

    @can('student_delete')

       <ul class="list-inline">
            <li class="list-inline-item"><a href="{{ route('manage.students.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li class="list-inline-item"><a href="{{ route('manage.students.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>

    @endcan


    <div class="card card-accent-primary">
        <div class="card-header">
            @lang('global.app_list')
        </div>

        <div class="card-body table-responsive">
            <table id="studentTable" class="table table-bordered table-striped {{ count($students) > 0 ? 'datatable' : '' }} @can('student_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('student_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.student.fields.first-name')</th>
                        <th>@lang('global.student.fields.middle-name')</th>
                        <th>@lang('global.student.fields.last-name')</th>
                        <th>Reg No</th>
                        <th>@lang('global.student.fields.dept')</th>
                        <th>Program</th>
                        <th>@lang('global.student.fields.batch')</th>
                        <th>@lang('global.student.fields.mobile-phone')</th>
                        <th>@lang('global.student.fields.gender')</th>
                        <th>DOB</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($students) > 0)
                        @foreach ($students as $student)
                            <tr data-entry-id="{{ $student->id }}">
                                @can('student_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan
                                <td field-key='first_name'>{{ $student->first_name }}</td>
                                <td field-key='middle_name'>{{ $student->middle_name }}</td>
                                <td field-key='last_name'>{{ $student->last_name }}</td>
                                <td field-key='reg_no'>{{ $student->reg_no }}</td>
                                <td field-key='department'>{{ $student->department->name ?? '' }}</td>
                                <td field-key='program'>{{ $student->program->name ?? '' }}</td>
                                <td field-key='batch'>{{ $student->batch->year ?? '' }}</td>
                                <td field-key='mobile_phone'>{{ $student->mobile_phone }}</td>
                                <td field-key='gender'>{{ $student->gender }}</td>
                                <td field-key='date_of_birth'>{{ $student->date_of_birth }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('student_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['manage.students.restore', $student->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-sm btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('student_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['manage.students.perma_del', $student->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-sm btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('student_view')
                                    <a href="{{ route('manage.students.show',[$student->id]) }}" class="btn btn-sm btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('student_edit')
                                    <a href="{{ route('manage.students.edit',[$student->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('student_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['manage.students.destroy', $student->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('student_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('manage.students.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function(){
            $('#studentTable').DataTable();
        });
    </script>
@endsection
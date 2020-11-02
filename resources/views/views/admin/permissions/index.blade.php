@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <p>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="card card-default">
        <div class="card-header">
            @lang('global.app_list')
        </div>
        <div class="card-body table-responsive">
            <table id="permissionTable" class="table table-bordered table-striped datatable dt-select">
                <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        <th>@lang('global.permissions.fields.name')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <!-- <td></td> -->
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('admin.permissions.edit',[$permission->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.permissions.destroy', $permission->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        // window.route_mass_crud_entries_destroy = '{{ route('admin.permissions.mass_destroy') }}';
        $(document).ready(function() {
                $('#permissionTable').DataTable();
            });

    </script>
@endsection

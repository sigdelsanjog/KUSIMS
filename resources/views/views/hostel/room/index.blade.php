@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelroom.title')</h3>
    @can('hostelroom_create')
    <p>
        <a href="{{ route('hostel.room.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    @can('hostelroom_delete')
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="{{ route('hostel.room.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li class="list-inline-item"><a href="{{ route('hostel.room.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="card card-default">
        <div class="card-header">
            @lang('global.app_list')
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($hostelrooms) > 0 ? 'datatable' : '' }} @can('hostelroom_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <!-- @can('hostelroom_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan -->

                        <th>@lang('global.hostelroom.fields.block')</th>
                        <th>@lang('global.hostelroom.fields.room')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($hostelrooms) > 0)
                        @foreach ($hostelrooms as $hostelroom)
                            <tr data-entry-id="{{ $hostelroom->id }}">
                                <!-- @can('hostelroom_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan -->

                                <td field-key='block'>{{ $hostelroom->block->name ?? '' }}</td>
                                <td field-key='room'>{{ $hostelroom->room }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('hostelroom_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.room.restore', $hostelroom->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('hostelroom_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.room.perma_del', $hostelroom->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('hostelroom_view')
                                    <a href="{{ route('hostel.room.show',[$hostelroom->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('hostelroom_edit')
                                    <a href="{{ route('hostel.room.edit',[$hostelroom->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('hostelroom_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.room.destroy', $hostelroom->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('hostelroom_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('hostel.room.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection

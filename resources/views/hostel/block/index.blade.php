@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelblock.title')</h3>
    @can('hostelblock_create')
    <p>
        <a href="{{ route('hostel.block.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    @can('hostelblock_delete')
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="{{ route('hostel.block.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li class="list-inline-item"><a href="{{ route('hostel.block.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="card card-default">
        <div class="card-header">
            @lang('global.app_list')
        </div>

        <div class="card-body table-responsive">
            <table id="example" class="table table-bordered table-striped {{ count($hostelblocks) > 0 ? 'datatable' : '' }} @can('hostelblock_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <!-- @can('hostelblock_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"></th>@endif
                        @endcan -->

                        <th>@lang('global.hostelblock.fields.name')</th>
                        <th>@lang('global.hostelblock.fields.location')</th>
                        <th>@lang('global.hostelblock.fields.incharge')</th>
                        <th>@lang('global.hostelblock.fields.contact')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($hostelblocks) > 0)
                        @foreach ($hostelblocks as $hostelblock)
                            <tr data-entry-id="{{ $hostelblock->id }}">
                                <!-- @can('hostelblock_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan -->

                                <td field-key='name'>{{ $hostelblock->name }}</td>
                                <td field-key='location'>{{ $hostelblock->location }}</td>
                                <td field-key='incharge'>{{ $hostelblock->incharge }}</td>
                                <td field-key='contact'>{{ $hostelblock->contact }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('hostelblock_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.block.restore', $hostelblock->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('hostelblock_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.block.perma_del', $hostelblock->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('hostelblock_view')
                                    <a href="{{ route('hostel.block.show',[$hostelblock->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('hostelblock_edit')
                                    <a href="{{ route('hostel.block.edit',[$hostelblock->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('hostelblock_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['hostel.block.destroy', $hostelblock->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('hostelblock_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('hostel.block.mass_destroy') }}'; @endif
        @endcan
    
    </script>
@endsection
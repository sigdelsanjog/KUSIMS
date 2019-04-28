@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.notice.title')</h3>
    @can('notice_create')
    <p>
        <a href="{{ route('notice.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    @can('notice_delete')
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="{{ route('notice.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li class="list-inline-item"><a href="{{ route('notice.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="card card-primary">
        <div class="card-header">
            @lang('global.app_list')
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($notices) > 0 ? 'datatable' : '' }} @can('notice_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('notice_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.notice.fields.title')</th>
                        <th>@lang('global.notice.fields.description')</th>
                        <th>@lang('global.notice.fields.from-date')</th>
                        <th>@lang('global.notice.fields.to-date')</th>
                        <th>Notice For</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($notices) > 0)
                        @foreach ($notices as $notice)
                            <tr data-entry-id="{{ $notice->id }}">
                                @can('notice_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='title'>{{ $notice->title }}</td>
                                <td field-key='description'>{{ $notice->description }}</td>
                                <td field-key='from-date'>{{ $notice->from_date }}</td>
                                <td field-key='to-date'>{{ $notice->to_date }}</td>
                                <td field-key='user_type'>{{ $notice->user_type }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('notice_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notice.restore', $notice->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('notice_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notice.perma_del', $notice->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('notice_view')
                                    <a href="{{ route('notice.show',[$notice->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('notice_edit')
                                    <a href="{{ route('notice.edit',[$notice->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('notice_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notice.destroy', $notice->id])) !!}
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
        @can('notice_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('notice.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
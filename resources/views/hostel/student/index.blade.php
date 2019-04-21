@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelroom.title')</h3>
    @can('hostelroom_create')
    <p>
        <a href="{{ route('hostel.book.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
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
            <table id="hostel_book" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>@lang('global.student.fields.first-name')</th>
                        <th>@lang('global.student.fields.last-name')</th>
                        <th>@lang('global.student.fields.dept')</th>
                        <th>Program</th>
                        <th>@lang('global.student.fields.batch')</th>
                        <th>Phone</th>
                        <th>@lang('global.student.fields.gender')</th>
                        <th>Hostel Name</th>
                        <th>@lang('global.hostelroom.fields.room')</th>
                        <th>Status</th>
                        @if(request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($hostelBookDetails) > 0)
                        @foreach ($hostelBookDetails as $bookDetail)
                            <tr data-entry-id="{{ $bookDetail->id }}">
                                <td field-key='first_name'>{{ $bookDetail->student->first_name ?? '' }}</td>
                                <td field-key='last_name'>{{ $bookDetail->student->last_name ?? '' }}</td>
                                <td field-key='dept'>{{ $bookDetail->student->department->name ?? '' }}</td>
                                <td field-key='program'>{{ $bookDetail->student->program->name ?? '' }}</td>
                                <td field-key='batch'>{{ $bookDetail->student->batch->year ?? '' }}</td>
                                <td field-key='phone'>{{ $bookDetail->student->phone ?? '' }}</td>
                                <td field-key='gender'>{{ $bookDetail->student->gender ?? '' }}</td>
                                <td field-key='blockname'>{{ $bookDetail->hostel->block->name ?? '' }}</td>
                                <td field-key='room'>{{ $bookDetail->hostel->room ?? '' }}</td>
                                <!-- <td field-key='hostel_status'>{{ $bookDetail->hostelStatus($bookDetail->status) ?? '' }}</td> -->
                                <td>
                                    <span  class="badge badge-warning">
                                        {{ $bookDetail->hostelStatus($bookDetail->status) ?? '' }}
                                    </span>
                                </td>
                                @if(($bookDetail->status) <= 2)
                                <td>
                                    <a href="{{ route('hostel.book.show',[$bookDetail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                </td>
                                @else
                                <td>&nbsp;</td>
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
        $(document).ready(function(){
            $('#hostel_book').DataTable();
        });
    </script>
@endsection

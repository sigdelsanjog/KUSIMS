<!-- @inject('request', 'Illuminate\Http\Request') -->
@extends('layouts.app')

@section('content')
    <h3 class="page-title">School</h3>
    <p>
        <a href="{{ route('setting.school.create') }}" class="btn btn-success">Add New School</a>
    </p>

    <div class="card card-primary">
        <div class="card-header">
           School List
        </div>


        <div class="card-body table-responsive">
            <table id="schoolTable" class="table table-bordered table-striped {{ count($schoolList) > 0 ? 'datatable' : '' }} dt-select">
                <thead> 
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Contact Person</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($schoolList) > 0)
                        @foreach ($schoolList as $school)
                            <tr data-entry-id="{{ $school->id }}">
                                <!-- <td></td> -->
                                <td>{!!$school->name!!}</td>
                                <td>{!!$school->address!!}</td>
                                <td>{!!$school->phone!!}</td>
                                <td>{!!$school->email!!}</td>
                                <td>{!!$school->contact_person!!}</td>
                                <td>{!!$school->status!!}</td>
                                
                                <td>
                                    <a href="{{ route('setting.school.edit',[$school->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $school->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <!-- <td colspan="9">@lang('global.app_no_entries_in_table')</td> -->
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        // window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        $(document).ready(function() {
	            $('#schoolTable').DataTable();
            } );
    </script>
@endsection
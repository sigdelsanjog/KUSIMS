<!-- @inject('request', 'Illuminate\Http\Request') -->
@extends('layouts.app')

@section('content')
    <p class="mt-2">
        <a href="{{ route('setting.department.create') }}" class="btn btn-success">Add New Department</a>
    </p>

    <div class="card card-info">
        <div class="card-header">
           School List
        </div>


        <div class="card-body table-responsive">
            <table id="departmentId" class="table table-bordered table-striped {{ count($departments) > 0 ? 'datatable' : '' }} dt-select">
                <thead> 
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        <th>Name</th>
                        <th>School</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Contact Person</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($departments) > 0)
                        @foreach ($departments as $department)
                            <tr data-entry-id="{{ $department->id }}">
                                <!-- <td></td> -->
                                <td>{!!$department->name!!}</td>
                                <td>
                                    @foreach ($department->school()->pluck('name') as $school)
                                        <span class="badge badge-info">{{ $school }}</span>
                                    @endforeach
                                </td>
                                <td>{!!$department->address!!}</td>
                                <td>{!!$department->phone!!}</td>
                                <td>{!!$department->email!!}</td>
                                <td>{!!$department->contact_person!!}</td>
                                <td>
                                    {{ $department->status == "1" ? "Active" : "In Active" }}
                                </td> 
                                <td>
                                    <a href="{{ route('setting.department.edit',[$department->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $department->id])) !!}
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
        //window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        $(document).ready(function(){
            #('departmentId').DataTable();
        });
    </script>
@endsection
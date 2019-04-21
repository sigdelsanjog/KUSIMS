@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hostelblock.title')</h3>

    <div class="card card-accent-danger">
        <div class="card-header">
            @lang('global.app_view')
        </div>

        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>First Name</th>
                            <td field-key='name'>{{ $hostelblock->student->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td field-key='location'>{{ $hostelblock->student->last_name}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td field-key='incharge'>{{ $hostelblock->student->phone }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td field-key='incharge'>{{ $hostelblock->student->gender }}</td>
                        </tr>
                        <tr>
                            <th>Hostel Status</th>
                            <td field-key='status'>{{$hostelblock->hostelStatus($hostelblock->status) }}</td>
                        </tr>
                    </table>

                    <hostel-assign id='{{$hostelblock->id}}' status='{{$hostelblock->status}}'></hostel-assign>
                </div>

                <div class="col-md-6">
                  <b-card style="max-width: 20rem;">
                   <img style="width: 20%; height:20%" class="card-img-top" src="{{ asset($hostelblock->student->image) }}" alt="Student Image">
                  </b-card>
                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('hostel.book.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bus Admin Page</h3>

    <div class="card card-default">

        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bus Route</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="true">Bus Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#busnotice" role="tab" aria-controls="busnotice" aria-selected="true">Bus Notice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#busrequest" role="tab" aria-controls="busrequest" aria-selected="true">Bus Request</a>
                        </li>
                    </ul>
                    <div class="tab-content">



                        <div class="tab-pane active show" id="home" role="tabpanel">
                            <div class="card card-default">
                                <div class="card-body table-responsive">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="card-body"><h4>User Profile</h4></div>
                                            <div class="card-body"><img src="{{ URL::to('/images/mahendra.jpg') }}" width="186" height="200" align="middle"></div>
                                        </div>
                                        <div class="col-sm-6" align="middle">
                                            <h4>Welcome</h4>
                                            <h2>Mr. Mahendra Kumar Niraula</h2>
                                            <hr>
                                            <p><strong>Date of Birth : </strong>April 10, 1977</p>
                                            <p><strong>Gender : </strong>Male</p>
                                            <hr>
                                            <p><strong>Email : </strong>mahendra.niraula@ku.edu.np</p>
                                            <p><strong>Contact : </strong>9841488156</p>
                                            <hr>
                                            <p><strong>Date of Joining : </strong>Jun 6, 1997</p>


                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="card-body table-responsive  col-md-6">
                                    <table id="userTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Route Name</th>
                                            <th>Station</th>
                                            <th>Bus No.</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if (count($Route) > 0)
                                            @foreach ($Route as $route)
                                                <tr data-entry-id="{{$route->id}}">
                                                    <td>{{$route->route_name}}</td>
                                                    <td>{{$route->station}}</td>
                                                    <td>{{$route->bus_no}}</td>
                                                    <td>
                                                        <span><a href="{{route('editRoute',['id'=>$route->id])}}" title="Edit Route"> <i class="fa fa-edit" ></i></a></span> !
                                                        <span><a href="{{route('delRoute',['id'=>$route->id])}}" title="Delete Route"><i class="fa fa-eraser"></i></a></span>
                                                    </td>

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
                                <div>
                                    <button class="btn btn-secondary btn-lg btn-block" type="button" style="width:200px;margin:0 50%;position:relative;left:+70px"><a href="{{route('routeApply')}}">Add Route</a></button>
                                </div>
                            </div>
                        </div>





                        <div class="tab-pane" id="messages" role="tabpanel">
                            <div class="card-body table-responsive">
                                <table id="userTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->

                                        <th>Name</th>
                                        <th>Phone no.</th>
                                        <th>Email</th>
                                        <th>Reg no.</th>
                                        <th>Dept Id</th>
                                        <th>Batch ID</th>
                                        <th>Bus Stop</th>
                                        <th>Bus Route</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if (count($BusApplyListStatus0) > 0)
                                        @foreach ($BusApplyListStatus0 as $BAlist)
                                            <tr data-entry-id="{{ $BAlist->id }}">
                                                <!-- <td></td> -->

                                                <td>{{$BAlist->first_name}} {{$BAlist->middle_name}} {{$BAlist->last_name}} </td>
                                                <td>{{$BAlist->phone}}</td>
                                                <td>{{$BAlist->email}}</td>
                                                <td>{{$BAlist->reg_no}}</td>
                                                <td>{{$BAlist->dept_no}}</td>
                                                <td>{{$BAlist->batch_id}}</td>
                                                <td>{{$BAlist->bus_stop}}</td>
                                                <td>{{$BAlist->route}}</td>
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




                        <div class="tab-pane" id="busnotice" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body table-responsive  col-md-6">
                                        <table id="userTable" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Notice</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>2019/04/25</td>
                                                    <td><a href="{{route('busNotice')}}">Notice for Bus Students</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2019/04/15</td>
                                                    <td><a href="{{route('busNotice')}}">Notice for Bus Students</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{route('addNotice')}}"><button class="btn btn-secondary btn-lg btn-block" type="button" style="width:200px;margin:0 50%;position:relative;left:+70px">Add Notice</button></a>
                                </div>
                            </div>
                        </div>





                        <div class="tab-pane" id="busrequest" role="tabpanel">

                            <div class="card-body table-responsive">
                                <table id="userTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->

                                        <th>Name</th>
                                        <th>Phone no.</th>
                                        <th>Email</th>
                                        <th>Reg no.</th>
                                        <th>Dept Id</th>
                                        <th>Batch ID</th>
                                        <th>Bus Stop</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if (count($BusApplyListStatus1) > 0)
                                        @foreach ($BusApplyListStatus1 as $BAlist)
                                            <tr data-entry-id="{{ $BAlist->id }}">
                                                <!-- <td></td> -->

                                                <td>{{$BAlist->first_name}} {{$BAlist->middle_name}} {{$BAlist->last_name}} </td>
                                                <td>{{$BAlist->phone}}</td>
                                                <td>{{$BAlist->email}}</td>
                                                <td>{{$BAlist->reg_no}}</td>
                                                <td>{{$BAlist->dept_no}}</td>
                                                <td>{{$BAlist->batch_id}}</td>
                                                <td>{{$BAlist->bus_stop}}</td>
                                                <td><button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="addID({{$BAlist->id}})">Approve</button></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bus Approve Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            {!!  Form::open(['method' => 'POST', 'route' => ['approveRoute']])!!}

                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="bid" value="" id="bid" >
                        <label class="col-md-3 col-form-label" for="select1">Bus Route</label>
                        <div class="col-md-9">
                            <select class="form-control" id="busroute" name="busroute">
                                @if(isset($Route))
                                    @foreach($Route as $route)
                                <option value="{{$route->route_name}}">{{$route->route_name}}</option>
                                    @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <script>
        function addID(id) {
            document.getElementById('bid').value=id;
        }
    </script>
@stop

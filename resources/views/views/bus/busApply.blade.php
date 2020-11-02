@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bus Apply Page</h3>

    <div class="card card-default">

        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <strong>Bus Apply Form</strong></div>
                            {!! Form::open(['method' => 'POST', 'route' => ['storeBusApply']]) !!}
{{--                            @csrf--}}
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">First Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{Auth::user()->first_name}}" id="firstname" type="text" name=firstname readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Middle Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{Auth::user()->middle_name}}" id="middlename" type="text" name="middlename" readonly>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Last Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{Auth::user()->last_name}}" id="lastname" type="text" name="lastname" readonly>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="email" value="{{Auth::user()->email}}" type="email" name="email" placeholder="Enter Email" autocomplete="email" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="password-input">Phone no</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id=phoneno" type="text" name="phoneno" placeholder="Phone no" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="select1">Batch</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="batch" name="batch">
                                                    <option value="1">2016</option>
                                                    <option value="1">2017</option>
                                                    <option value="1">2017</option>
                                                    <option value="1">2019</option>
                                                    <option value="1">2020</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="password-input">Registration no.</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="regno" type="text" name="regno" placeholder="Registration no" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="select1">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="department" name="department">
                                            @if(isset($deparmentList))
                                                @foreach($deparmentList as $dplist)
                                                    <option value="{{$dplist->id}}">{{$dplist->name}}</option>
                                                @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="password-input">Bus Stop</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="busStop" type="text" name="busStop" placeholder="Enter bus stop" >
                                </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date-input">Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="date-input" type="date" name="date-input" placeholder="date">
                                    </div>
                                </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-dot-circle-o"></i> Apply</button>

                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <h4 class="page-title">Bus Route Update Page</h4>


    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <strong>Bus Route Update Form</strong></div>
                <div class="col-md-7">
                    {!!  Form::open(['method' => 'POST', 'action' => ['BusController@updateRoute', $getBusRoute->id]])!!}
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Route</label>
                        <div class="col-md-9">
                            <input class="form-control" value="{{$getBusRoute->route_name}}" id="route" type="text" name="route" placeholder="Enter Route name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Station</label>
                        <div class="col-md-9">
                            <input class="form-control" value="{{$getBusRoute->station}}" id="station" type="text" name="station" placeholder="Enter Station">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Bus no</label>
                        <div class="col-md-9">
                            <input class="form-control" value="{{$getBusRoute->bus_no}}" id="busno" type="text" name="busno" placeholder="Enter Bus no">
                        </div>
                    </div>

                    <button class="btn btn-secondary btn-lg btn-block" type="Submit" style="width:100px;margin:0 50%;position:relative;left:20px">Submit</button>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>


@stop

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.buspage.title')</h3>

    <div class="card card-default">

        <div class="card-body table-responsive">
            <div class="row">
                  <div class="col-sm-5"><img src="" width="400px" height="425px"></div>
                  <div class="col-sm-4">
                                        <div class="card border-info">
                                            <div class="card-header"><strong>Head of Physical Facility</strong></div>
                                <div class="card-body"><div class="col-sm-5"><img src="{{url('/')}}/ images/mahendra.jpg" width="150" height="180" align="middle"> </div><div class="col-sm-7">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
                                        ex ea commodo consequat.</div></div>
                                    </div>

                                    <div class="card border-info">
                                        <div class="card-header"><strong>Coordinator of Bus Facility</strong></div>
                                <div class="card-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
                                ex ea commodo consequat.</div>
                                    </div>


                 </div>
                  <div class="col-sm-3">
                    <div class="card">
                                <div class="card-header">
                                <strong>Action</strong>
                                </div>
                                <div class="card-body">
                                <button class="btn btn-secondary btn-lg btn-block" type="button"><a href="{{route('busNotice')}}">Notice</a></button>
                                <button class="btn btn-secondary btn-lg btn-block" type="button"><a href="{{route('busApply')}}">Apply New</a></button>
                                <button class="btn btn-secondary btn-lg btn-block" type="button">Payment</button>
                                </div>
                                </div>
                  </div>
            </div>
        </div>
    </div>
@stop

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.buspage.title')</h3>

    <div class="card card-default">

        <div class="card-body table-responsive">
            <div class="row">
                  <div class="col-sm-3"><img src="" width="200px" height="200px"></div>
                  <div class="col-sm-6">
                                        <div class="card border-info">
                                <div class="card-header">Card outline</div>
                                <div class="card-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
                                ex ea commodo consequat.</div>
                                    </div>

                                    <div class="card border-info">
                                <div class="card-header">Card outline</div>
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
                                <button class="btn btn-success btn-lg btn-block" type="button">Notice</button>
                                    <button class="btn btn-info btn-lg btn-block" type="button"><a href="{{route('busApply')}}">Apply New</a></button>
                                <button class="btn btn-secondary btn-lg btn-block" type="button">Payment</button>
                                </div>
                                </div>
                  </div>
            </div>
        </div>
    </div>
@stop

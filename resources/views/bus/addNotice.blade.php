@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <h4 class="page-title">Bus Notice Add Page</h4>


    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <strong>Bus Notice Add Form</strong></div>
                <div class="col-md-7">
                    {!!  Form::open(['method' => 'POST', 'route' => ['submitNotice']])!!}
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="text-input">Date</label>
                        <div class="col-md-8">
                            <input class="form-control" value="" id="date" type="date" name="date" placeholder="Enter Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="text-input">Notice Title</label>
                        <div class="col-md-8">
                            <input class="form-control" value="" id="title" type="text" name="title" placeholder="Enter Notice Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="file">Notice File</label>
                        <div class="col-md-8">
                            <input class="form-control" value="" id="filetitle" type="file" name="filetitle"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                    </div>

                    <button class="btn btn-secondary btn-lg btn-block" type="Submit" style="width:100px;margin:0 50%;position:relative;left:20px">Submit</button>
                    <div class="col-md-6">
                    </div>{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop

@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.batch.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.batch.fields.year')</th>
                            <td field-key='year'>{{ $batch->year }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.batch.fields.description')</th>
                            <td field-key='description'>{!! $batch->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.batches.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.feedbacks.title')</h3>

    <div class="card card-primary">
        <div class="card-header">
            @lang('global.app_list')
        </div>

       <div class="card-body table-responsive">
         
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped">
            <thead>
                        <tr>
                            <th>@lang('global.feedbacks.fields.message')</th>
                            <th>Send by Student:</th>
                        </tr>
            </thead>

            <tbody>
                        @foreach($recieves as $recieve)


                        <?php $student = DB::table('Users')->where('id', $recieve->student_id)->value('name'); ?>

                        <tr>
                            <td>
                                {{$recieve->message}} 
                            </td>

                            <td>
                                <?php echo $student;?>
                            </td>

                        </tr>
                        @endforeach
            </tbody>            
            </table>
            </div>
            </div>
@endsection



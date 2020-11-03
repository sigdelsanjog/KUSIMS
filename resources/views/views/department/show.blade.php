@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show schoolinfo
    </h1>
    <br>
    <a href='{!!url("schoolinfo")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Schoolinfo Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>Name</b> </td>
                <td>{!!$schoolinfo->Name!!}</td>
            </tr>
            <tr>
                <td> <b>Address</b> </td>
                <td>{!!$schoolinfo->Address!!}</td>
            </tr>
            <tr>
                <td> <b>Phone</b> </td>
                <td>{!!$schoolinfo->Phone!!}</td>
            </tr>
            <tr>
                <td> <b>Email</b> </td>
                <td>{!!$schoolinfo->Email!!}</td>
            </tr>
            <tr>
                <td> <b>Dean</b> </td>
                <td>{!!$schoolinfo->Dean!!}</td>
            </tr>
            <tr>
                <td> <b>ContactPerson</b> </td>
                <td>{!!$schoolinfo->ContactPerson!!}</td>
            </tr>
            <tr>
                <td> <b>Status</b> </td>
                <td>{!!$schoolinfo->Status!!}</td>
            </tr>
            <tr>
                <td> <b>Description</b> </td>
                <td>{!!$schoolinfo->Description!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
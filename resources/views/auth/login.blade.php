@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                There were problems with input:
                                <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <form method="POST" action="{{ url('login') }}" autocomplete="off">

                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       autocomplete="off"
                                       value="{{ old('email') }}">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input type="password"
                                        class="form-control"
                                        autocomplete="off"
                                        name="password">
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                <div class="col-9 text-right">
                                    <a href="{{ url('/redirect') }}" class="btn btn-danger"><i class="fab fa-google-plus-square"></i> Login With Google</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>KU Student Mail</h2>
                            <p>
                                <img height="180" src="/img/ku-logo.png">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
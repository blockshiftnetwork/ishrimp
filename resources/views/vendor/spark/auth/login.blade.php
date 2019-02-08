@extends('spark::layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="row justify-content-center mx-auto" style="margin-top:10%">
        <div class="col-lg-5">
            <div class="card  card-login card-default mx-auto">


                <img src="{{ asset('images/top-login-header.svg') }}" alt="logo" class="logo-header w-25 mx-auto mt-5">
                <div class="card-body">
                    @include('spark::shared.errors')

                    <form class="form-horizontal form-materia" role="form" method="POST" action="/login">
                        {{ csrf_field() }}
                        <h3 class="box-title m-b-20">Inicio de sesion</h3>
                        <!-- E-Mail Address -->
                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{__('E-Mail')}}" autofocus>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group row mt-4">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-check-input"> {{__('Remember Me')}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{__('Forgot Your Password?')}}</a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="form-group row mt-4 mb-5 ml-auto mr-auto">
                            <div class="col-md-9 mx-auto ">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{__('Login')}}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

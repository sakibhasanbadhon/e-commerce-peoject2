@extends('layouts.admin')
@section('title')
    Register
@endsection
@section('auth-content')
<br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="bg-silver-300">
                <div class="content">
                    <div class="brand">
                        {{-- <a class="link" href="index.html">AdminCAST</a> --}}
                    </div>
                    <form id="login-form" action="{{ route('register') }}" class="p-3" method="post">
                        @csrf
                        <h2 class="login-title">Log in</h2>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-user"></i></div>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Full name" required >
                                @if (session('error'))
                                    <strong style="color:red">  {{ session('error') }}</strong>
                                @endif
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" required>
                                @if (session('error'))
                                    <strong style="color:red">  {{ session('error') }}</strong>
                                @endif
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-user"></i></div>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="phone number" required >
                                @if (session('error'))
                                    <strong style="color:red">  {{ session('error') }}</strong>
                                @endif
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirmed Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <label class="ui-checkbox ui-checkbox-info">
                                <input type="checkbox">
                                <span class="input-span"></span>Remember me</label>
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-block" type="submit">Signup</button>
                        </div>
                        <div class="social-auth-hr py-3">
                            <span>Or Signup with</span>
                        </div>
                        {{-- <div class="text-center social-auth m-b-20">
                            <a href="javascript:;" class="btn btn-social-icon btn-google m-r-5"><i class="fa fa-google"></i></a>
                            <a href="javascript:;" class="btn btn-social-icon btn-twitter m-r-5"><i class="fa fa-twitter"></i></a>
                            <a href="javascript:;" class="btn btn-social-icon btn-facebook m-r-5"><i class="fa fa-facebook"></i></a>
                            <a href="javascript:;" class="btn btn-social-icon btn-linkedin m-r-5"><i class="fa fa-linkedin"></i></a>
                            <a href="javascript:;" class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('login.google') }}" class="d-block btn btn-danger"><i class="fa fa-google"> Sign in with Google</i></a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('login.facebook') }}" class="d-block my-2 btn btn-info"><i class="fa fa-facebook"> Sign in with Google Facebook</i></a>
                            </div>
                        </div>

                        <div class="text-center">Not a member?
                            <a class="color-blue" href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection


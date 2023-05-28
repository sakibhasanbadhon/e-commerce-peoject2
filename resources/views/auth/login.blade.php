@extends('layouts.admin')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="bg-silver-300">
                <div class="content">
                    <div class="brand">
                        {{-- <a class="link" href="index.html">AdminCAST</a> --}}
                    </div>
                    <form id="login-form" action="{{ route('login') }}" class="p-3" method="post">
                        @csrf
                        <h2 class="login-title">Log in</h2>
                        <div class="form-group">
                            <div class="input-group-icon right">
                                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" >
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
                                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">

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
                            <button class="btn btn-info btn-block" type="submit">Login</button>
                        </div>
                        <div class="social-auth-hr">
                            <span>Or login with</span>
                        </div>
                        <div class="text-center social-auth m-b-20">
                            <a class="btn btn-social-icon btn-twitter m-r-5" href="javascript:;"><i class="fa fa-twitter"></i></a>
                            <a class="btn btn-social-icon btn-facebook m-r-5" href="javascript:;"><i class="fa fa-facebook"></i></a>
                            <a class="btn btn-social-icon btn-google m-r-5" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                            <a class="btn btn-social-icon btn-linkedin m-r-5" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                            <a class="btn btn-social-icon btn-vk" href="javascript:;"><i class="fa fa-vk"></i></a>
                        </div>
                        <div class="text-center">Not a member?
                            <a class="color-blue" href="register.html">Create accaunt</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection


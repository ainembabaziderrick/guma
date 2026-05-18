@extends('layouts.auth')

@section('login')
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{ url('login') }}">
                <b>Reset</b> Password
            </a>
            @include('message')
        </div>

        <p class="login-box-msg">Enter your email to reset your password</p>
 
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="post" class="form-forgot-password">
            @csrf
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                    <span class="help-block">{{ $message }}</span>
                @else
                    <span class="help-block with-errors"></span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/login') }}" class="text-muted">Back to Login</a>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

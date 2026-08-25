@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card fade-in">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">
                    <i class="fas fa-key"></i> Forgot Password
                </h2>
                <p class="text-center text-muted mb-4">
                    Enter your email and we'll send you a password reset link.
                </p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> {{ __('Send Password Reset Link') }}
                        </button>
                    </div>

                    <p class="text-center mt-3 mb-0">
                        <a href="{{ route('login') }}">Back to login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card fade-in">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">
                    <i class="fas fa-sign-in-alt"></i> Welcome Back
                </h2>
                <p class="text-center text-muted mb-4">Login to share your travel stories</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <hr>

                    <p class="text-center mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}">Sign up here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

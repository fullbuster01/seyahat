@extends('layouts.auth')
@section('title', 'Resend Activaton Email')

@section('content')

    <main class="reset-container">
        <div class="container">
            <div class="row page-auth d-flex align-items-center">
                <div class="section-left col-12 col-md-6">
                    <h1 class="mb-4">We Explore The New <br>
                        Life Much Better</h1>
                    <img src="{{ url('frontend/images/login-image@2x.png') }}" alt="login" class="w-75 d-none d-sm-flex">
                </div>
                <div class="section-right col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{ route('home') }}">
                                    <img src="{{ url('frontend/images/logo.png') }}" alt="logo" class="w-50 mb-4">
                                </a>
                            </div>

                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('auth.activate.resend') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input type="email"  id="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                
                                <button type="submit" class="btn btn-login btn-block">{{ __('Resend Activation Email') }}</button>
                                
                                <p class="text-center mt-3">
                                    Create an account? <a href="{{ route('register') }}">Register</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection





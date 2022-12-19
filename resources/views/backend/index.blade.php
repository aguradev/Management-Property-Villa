@extends('backend.temp.auth-template')

@section('title', 'Login Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">

            @if (session('flash_message'))
                <div class="alert alert-success">
                    <strong>{{ session('flash_message') }}</strong>
                </div>
            @endif

            @if (session()->has('error_message'))
                <div class="alert alert-danger">
                    <strong>{{ session('error_message') }}</strong>
                </div>
            @endif

            <!-- Logo -->
            <div class="app-brand justify-content-center py-2 mb-3">
                <a href="index.html" class="app-brand-link">
                    <span class="app-brand-text demo text-body fw-bolder">Login Dashboard</span>
                </a>
            </div>
            <!-- /Logo -->

            <form id="formAuthentication" class="mb-3" action="{{ route('auth-login') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text"
                        class="form-control @error('username')
                    is-invalid
                    @enderror"
                        id="username" name="username" placeholder="Enter your email or username" autofocus />
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password"
                            class="form-control @error('password')
                        is-invalid
                        @enderror""
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
            </form>

            <p class="text-center">
                <span>Don't have account ? </span>
                <a href="{{ route('register') }}">
                    <span>Create an account</span>
                </a>
            </p>
        </div>
    </div>
@endsection

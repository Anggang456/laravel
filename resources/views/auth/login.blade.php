@extends('layouts.app') 

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img
                    src="https://res.cloudinary.com/dwe1tyctm/image/upload/v1673620971/6505894-removebg-preview_mbidqc.png"
                    class="img-fluid"
                    alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example13">{{ __('Email Address') }}</label>
                        <input
                            type="email"
                            id="form1Example13"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required="required"
                            autocomplete="email"
                            autofocus/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example23">{{ __('Password') }}</label>
                        <input
                            type="password"
                            id="form1Example23"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            name="password"
                            required="required"
                            autocomplete="current-password"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Checkbox -->
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                    </div>

                    <a
                        class="btn btn-secondary btn-lg btn-block"
                        href="{{ url('register') }}"
                        role="button">
                        {{ __('Register') }}
                    </a>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection
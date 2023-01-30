@extends('layouts.app') 

@section('content')
<br>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img
                    src="https://res.cloudinary.com/dwe1tyctm/image/upload/v1673620971/6666912-removebg-preview_vrljyn.png"
                    class="img-fluid"
                    alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="POST" action="{{ route('register') }}" >
                        @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example13">{{ __('Username') }}</label>
                        <input
                            type="name"
                            id="form1Example13"
                            class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
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
                            autofocus="autofocus"/>
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

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example23">{{ __('Confirm Password') }}</label>
                        <input id="form1Example23" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">

                    </div>

                    

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998">{{ __('Register') }}</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                    </div>

                    <a
                        class="btn btn-secondary btn-lg btn-block"
                        href="{{ url('login') }}"
                        role="button">
                        {{ __('Login') }}
                    </a>

                </form>
            </div>
        </div>
    </div>
</section>
<br>
@endsection
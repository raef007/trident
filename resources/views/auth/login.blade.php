@extends('layouts.app')

@section('content')
<div
    class="splash-container"
>
    <div class="login-splash"></div>
    
    <div class="splash-widgets">
        <h1 class="white">{{ config('app.name') }}</h1>
        <current-time></current-time>
    </div>
    
    <v-card class="mx-auto splash-login-card">
        <v-card-text>
            <v-form class="splash-login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                    <div class="col-md-5">
                        <v-text-field id="email" label="{{ __('Email Address') }}" type="email" class="@error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus></v-text-field>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <v-text-field id="password" label="{{ __('Password') }}" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password"></v-text-field>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <v-btn size="x-large" type="submit" variant="flat" color="success">
                            {{ __('Login') }}
                        </v-btn>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </v-form>
        </v-card-text>
    </v-card>
</div>
@endsection

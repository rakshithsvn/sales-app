@extends('front.layout')

@section('css')
<style>
    section {
        margin: 0;
        padding: 0
    }

    section#vision {
        margin-bottom: 50px
    }

    .form-group .input-lg {
        margin: 15px 20px;
    }

    .btn-block {
        margin: 10px 20px;
    }

    .breadcrumb-wrapper img {
        width: 100%;
        height: 30vh;
        object-fit: cover;
    }
</style>
@endsection

@section('main')

<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- INNER-BANNER -->
</header>

<section>
    <div class="breadcrumb-wrapper">
        <!-- <img data-sizes="auto" data-src="/assets/images/background/5.jpg" class="lazyload img-fluid full-image" alt="Full Image" data-mask="80"> -->
    </div>
</section>

<section id="vision">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                @if (session('confirmation-success'))
                @component('front.components.alert')
                @slot('type')
                success
                @endslot
                {!! session('confirmation-success') !!}
                @endcomponent
                @endif
                @if (session('confirmation-danger'))
                @component('front.components.alert')
                @slot('type')
                error
                @endslot
                {!! session('confirmation-danger') !!}
                @endcomponent
                @endif

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- <!-- Email Address -->
                <div class="mb-4">
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
                    <x-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <!-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remembers me') }}</span>
                    </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
            </form> --}}



            @if ($errors->has('email'))
            @component('front.components.error')
            {{ $errors->first('email') }}
            @endcomponent
            @endif
            <fieldset>
                <div>
                    <h2 style="margin-top: 30px;">Please Sign In</h2>
                    <hr class="colorgraph">

                    <div class="form-group mb-4">
                        {{-- <input id="email" type="text" placeholder="@lang('Login')" class="full-width" name="email" value="{{ old('email') }}" required autofocus> --}}
                        <input type="text" name="email" id="email" class="form-control input-lg" value="{{ old('email') }}" placeholder="@lang('Login')" required autofocus>
                    </div>
                    <div class="form-group mb-4">
                        {{-- <input id="password" type="password" placeholder="@lang('Password')" class="full-width" name="password" required>  --}}
                        <input type="password" name="password" id="password" class="form-control input-lg password-text" placeholder="@lang('Password')" required>
                    </div>

                    <div class="form-group set-max-iframe-height col-md-12 mb-4">
                        <div class="g-recaptcha" data-sitekey="{{ config('app.site_key') }}"></div>
                    </div>

                    <!-- Remember Me -->
                    <!-- <div class="form-group">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 input-lg"  name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </div> -->

                    {{-- <div class="form-group">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 input-lg" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div> --}}

                <div class="form-group mb-4">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="@lang('Login')">
                    {{-- <a href="" class="btn btn-lg btn-primary btn-block reduce-pad color_white">Login</a>  --}}

                </div>

        </div>
        </fieldset>
        </form>
    </div>

    </div>
    </div>
</section>

@endsection






















{{--






<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-label for="email" :value="__('Email')" />

    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
</div>

<!-- Password -->
<div class="mt-4">
    <x-label for="password" :value="__('Password')" />

    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-button class="ml-3">
        {{ __('Log in') }}
    </x-button>
</div>
</form>
</x-auth-card>
</x-guest-layout>
--}}
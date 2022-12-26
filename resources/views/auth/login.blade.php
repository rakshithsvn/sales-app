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
<span class="login100-form-title p-b-43"> {!! session('status') !!} </span>

<form method="POST" action="{{ route('login') }}" class=" validate-form">
    @csrf
    <span class="login100-form-title p-b-43"> Login </span>

    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input class="input100" type="email" name="email" required autofocus />
        <span class="focus-input100"></span>
        <span class="label-input100">Email</span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password" required />
        <span class="focus-input100"></span>
        <span class="label-input100">Password</span>
    </div>

    <div class="form-group set-max-iframe-height col-md-12 mt-4 mb-2">
        <div class="g-recaptcha" data-sitekey="{{ config('app.site_key') }}"></div>
    </div>

    <!-- <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" />
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1"> Forgot Password? </a>
                    </div>
                </div> -->

    <div class="container-login100-form-btn p-t-30">
        <button class="login100-form-btn" type="submit">Login</button>
    </div>
</form>

@endsection

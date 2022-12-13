@extends('back.layout') 

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
@endsection  

@section('main')

@if (session('post-ok'))
@component('back.components.alert')
@slot('type')
success
@endslot
{!! session('post-ok') !!}
@endcomponent
@endif

@if (session('post-danger'))
@component('back.components.alert')
@slot('type')
danger
@endslot
{!! session('post-danger') !!}
@endcomponent
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <form role="form" method="POST" class="col-sm-6" autocomplete="off" action="{{ route('users.storepassword') }}">
                {{ csrf_field() }}

                <input id="userId" name="id" type="hidden" value="{{$user->id}}">

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">@lang('Name')</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('Email')</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('Current Password')</label>
                        <input type="password" class="form-control" id="oldPass" name="oldPass" required>
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('New Password')</label>
                        <input type="password" class="form-control" id="newPass" name="newPass" required>
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('Confirm New Password')</label>
                        <input type="password" class="form-control" id="confPass" name="confPass" required>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit">@lang('Submit')</button>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">

    $(document).on('click','#submit',function(e) {

       if($('#newPass').val() !== $('#confPass').val())
       {
         swal("Confirm Password does not match with the New Password.");
         $('#newPass').val('');
         $('#confPass').val('');
         return false;
     }
 });
</script>
@endsection
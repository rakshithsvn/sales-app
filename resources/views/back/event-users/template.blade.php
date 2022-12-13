@extends('back.layout')

@section('css')

@endsection

@section('main')

@yield('form-open')
{{ csrf_field() }}

    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
            @if (session('user-updated'))
                @component('back.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('user-updated') !!}
                @endcomponent
            @endif
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">@lang('Name')</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{isset($event_user) ? $event_user->name : ''}}" required>
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email">@lang('Email')</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{isset($event_user) ? $event_user->email : ''}}" required>
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : ''}}">
                            <label for="mobile_number">@lang('Mobile Number')</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{isset($event_user) ? $event_user->mobile_number : ''}}" required>
                            {!! $errors->first('mobile_number', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                            <label for="address">@lang('Address')</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{isset($event_user) ? $event_user->address : ''}}" required>
                            {!! $errors->first('address', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('lab_name') ? 'has-error' : ''}}">
                            <label for="lab_name">@lang('Lab Name')</label>
                            <input type="text" class="form-control" id="lab_name" name="lab_name" value="{{isset($event_user) ? $event_user->lab_name : ''}}" required>
                            {!! $errors->first('lab_name', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
                                    <label for="district">@lang('District')</label>
                                    <input type="text" class="form-control" id="district" name="district" value="{{isset($event_user) ? $event_user->district : ''}}" required>
                                    {!! $errors->first('district', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                                    <label for="state">@lang('state')</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{isset($event_user) ? $event_user->state : ''}}" required>
                                    {!! $errors->first('state', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('pin_code') ? 'has-error' : ''}}">
                                    <label for="pin_code">@lang('pin_code')</label>
                                    <input type="text" class="form-control" id="pin_code" name="pin_code" value="{{isset($event_user) ? $event_user->pin_code : ''}}" required>
                                    {!! $errors->first('pin_code', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                        </div>
                        @if(!@$event_user)
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password">@lang('Password')</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : ''}}">
                            <label for="password_confirm">@lang('Confirm Password')</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"  required>
                            {!! $errors->first('password_confirm', '<small class="help-block">:message</small>') !!}
                        </div>
                        @endif
                            <div class="checkbox">
                                <label class="mr-5">
                                    <input type="checkbox" name="is_verified" {{ old('is_verified') ? 'checked' : ''}}> @lang('Verified')
                                </label>
                                <!-- <label>
                                    <input type="checkbox" name="confirmed" {{ old('confirmed') ? 'checked' : ''}}> @lang('Confirmed')
                                </label> -->
                            </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        <a href="{{route('event-users.index')}}" class="btn btn-default">@lang('Cancel')</a> 
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection


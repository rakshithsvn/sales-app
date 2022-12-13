@extends('back.layout')

@section('css')

@endsection

@section('main')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
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
                <form role="form" method="POST" class="col-sm-6" autocomplete="off" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">@lang('Name')</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email">@lang('Email')</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group">
                            <label for="role">@lang('Role')</label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin" {{ old('role')}}>@lang('Administrator')</option>
                                <option value="redac" {{ old('role') }}>@lang('Redactor')</option>
                              {{--  <option value="user" {{ old('role')}}>@lang('User')</option>--}}
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password">@lang('password')</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : ''}}">
                            <label for="password_confirm">@lang('password_confirm')</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"  required>
                            {!! $errors->first('password_confirm', '<small class="help-block">:message</small>') !!}
                        </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="valid" {{ old('valid') ? 'checked' : ''}}> @lang('Valid')
                                </label>
                                <label>
                                    <input type="checkbox" name="confirmed" {{ old('confirmed') ? 'checked' : ''}}> @lang('confirmed')
                                </label>
                            </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        <a href="{{route('users.index')}}" class="btn btn-default">@lang('Cancel')</a> 
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection


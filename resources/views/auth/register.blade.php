@extends('auth.master')

@section('title_postfix', '| Register')

@section('content')
    <div class="register-box">
        <div class="register-logo">
{{--            <img src="{{asset('main-logo.png')}}" class="logo" alt="Hait Entertainment" width="300px">--}}
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            {!! Form::open(['method'=>'POST','route'=>'register']) !!}
            <div class="form-group has-feedback @error('name') has-error @enderror">
                {!! Form::text('name', null, array('placeholder' => 'Enter Full Name','class' => 'form-control','required'=>'true')) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback @error('email') has-error @enderror">
                {!! Form::email('email', null, array('placeholder' => 'Enter Email','class' => 'form-control','required'=>'true')) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback @error('phone') has-error @enderror">
                {!! Form::text('phone', null, array('placeholder' => 'Enter Phone Number','class' => 'form-control','required'=>'true')) !!}
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback @error('password') has-error @enderror">
                {!! Form::password('password', array('placeholder' => 'Enter Password','class' => 'form-control')) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback @error('password_confirmation') has-error @enderror">
                {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
            {!! Form::close() !!}
            <p></p>
            <a href="{{route('login')}}" class="text-center">I already have a membership</a>
        </div>

    </div>
@endsection


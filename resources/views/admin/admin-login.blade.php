@extends('layouts.app')

@section('content1')
        <div style="width: 50%;">
                    <div class="panel panel-default" >
                        <div class="panel-heading" style="display:flex ;justify-content: center;">ورود </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">آدرس ایمیل </label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">رمز عبور</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-push-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>  من را به خاطر بسپار
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-push-4">
                                        <button style="background-image: linear-gradient(to right, #254f74, #244c6f, #23486b, #214566, #204262);" type="submit" class="btn btn-primary">
                                            ورود
                                        </button>
                                       {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                            رمز عبور خود را فراموش کرده اید؟
                                        </a>--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
@endsection



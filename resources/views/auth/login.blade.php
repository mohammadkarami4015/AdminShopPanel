@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('ورود') }}</div>

                    <div class="card-body" dir="rtl">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-3 col-form-label text-md-right">{{ __('ایمیل آدرس') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>


                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-3 col-form-label text-md-right">{{ __('رمز ورود') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    <div style="font-size: 12px">
                                        @include('error')
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                        <div class="form-group row">--}}
                            {{--                            <div class="col-md-6 offset-md-4">--}}
                            {{--                                <div class="form-check">--}}
                            {{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                            {{--                                    <label class="form-check-label" for="remember">--}}
                            {{--                                        {{ __('Remember Me') }}--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="form-group row ">
                                <div class="col-md offset-md-7">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ورود') }}
                                    </button>

                                    {{--                                @if (Route::has('password.request'))--}}
                                    {{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--                                        {{ __('Forgot Your Password?') }}--}}
                                    {{--                                    </a>--}}
                                    {{--                                @endif--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

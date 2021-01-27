@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div  class="card-header"></div>

                    <div class="card-body" dir="rtl">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">


                                <div class="col-md-10">
                                    <input id="email" type="email" placeholder="ایمیل"
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

                                <div class="col-md-10">
                                    <input id="password" type="password" placeholder="رمز ورود"
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



                            <div style="float: right" class="form-group row ">
                                <div class="col-md ">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ورود') }}
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

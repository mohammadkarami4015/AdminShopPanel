@extends('layouts.result')

@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2  col-sm-12 col-xs-12">
                <div class="ibox float-e-margins">
                    <div style="display: flex;font-size: large;justify-content: center;align-items: center;flex-direction: column;margin: 50px 0;border: 1px solid lightgray;border-radius: 6px;padding: 35px;background-color: white;box-shadow: 0px 2px 6px 1px lightgrey;">
                        <p>کد ملی :  {{$user_test->user->national_id}}</p>
                        <p>کد آزمون :  {{$user_test->code}}</p>
                    </div>
                    @foreach($results as $result)
                        <div style="display: flex;justify-content: center;align-items: center;flex-direction: column;margin: 50px 0;border: 1px solid lightgray;border-radius: 6px;padding: 35px;background-color: white;box-shadow: 0px 2px 6px 1px lightgrey;">
                            <div style="margin: 10px 0;">{{$result->title}}</div>
                            <div class="valueDiv">{!! $result->value !!}</div>
                        </div>
                    @endforeach
                    <div style="display: flex;font-size: large;justify-content: center;align-items: center;flex-direction: column;margin: 50px 0;border: 1px solid lightgray;border-radius: 6px;padding: 35px;background-color: white;box-shadow: 0px 2px 6px 1px lightgrey;">
                        <a class="btn btn-sm btn-info"  href="{{ url()->previous() }}">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

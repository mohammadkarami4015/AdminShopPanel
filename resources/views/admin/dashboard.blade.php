@extends('layouts.admin')

@section('title')
    {{$site_title}}  | داشبورد
@endsection

@section('admins')
    active
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <h2 class="text-center">خوش آمدید</h2>
                        <h1 class="logo-name text-center"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


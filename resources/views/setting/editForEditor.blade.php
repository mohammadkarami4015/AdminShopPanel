@extends('layouts.admin')
@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-pull-2">
            <h2>تنظیمات</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>تنظیمات </a>
                </li>
                <li class="active">
                    <strong> ویرایش {{ ' '.$setting->key}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-pull-1 ">
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش</div>
                    <div data-pjax  class="panel-body">
                        <form data-pjax class="form-horizontal" method="POST"
                              action="{{ route('setting.update',['id'=>$setting->id]) }}">
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}
                            <div class="col-md-12" style="margin-bottom: 10px;display: block;">
                                <textarea style="width: 100%" id="summernote" type="text" class="form-control" name="value"  >{{ $setting->value}}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        بروز رسانی
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

@section('footer')
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script>
        $(document).ready(function(){
            $('#summernote').summernote();
            console.log($('.summernote').summernote('code'))

            $(".summernote").trigger('summernote.change');
            $(".summernote").summernote({

                onChange: function () {
                    $('.note-editor').find('textarea').attr('name', 'value');

                    $('.note-codable').text($('.note-editable').html());
                }
            });
            $(".summernote").trigger('summernote.change');
        });
    </script>
@endsection

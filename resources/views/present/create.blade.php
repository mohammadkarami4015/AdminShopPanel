@extends('layouts.admin')

@section('title')
    {{$site_title}} ارائه دوره جدید
@endsection

@section('present')
    active
@endsection

@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <style>
        .note-editor .note-editable{
            background-color: #f8f8ffa1;
            border: 1px solid lightgray;
            border-top: 0 solid;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            min-height: 250px;
        }
        .note-editor .note-toolbar {
            border: 1px solid lightgray;
            border-bottom: 0 solid;
            border-top-right-radius:5px;
            border-top-left-radius:5px;
            padding-bottom: 15px;
            background-color: #1ab394;
        }
    </style>
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ارائه دوره جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>ارائه دوره</a>
                </li>
                <li class="active">
                    <strong>ارائه دوره جدید</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> ارائه دوره جدید</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('present.store') }}" >
                            {{ csrf_field() }}

                            @if(Gate::check('teacher'))
                                <input  type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" required >
                            @elseif(Gate::check('super_admin'))
                                <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                    <label for="user_id" class="col-md-4 control-label">استاد </label>
                                    <div class="col-md-6">
                                        <select  class="form-control" name="user_id" id="" >
                                            <option disabled selected>انتخاب استاد</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                                <label for="course_id" class="col-md-4 control-label">دوره </label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="course_id" id="" >
                                        <option disabled selected>انتخاب دوره</option>
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('submit_date') ? ' has-error' : '' }}">
                                <label for="submit_date" class="col-md-4 control-label">تاریخ ثبت نام تا </label>
                                <div class="col-md-6" id="">
                                    <input  type="text" class="form-control" name="submit_date" value="{{ old('submit_date') }}" id="solardate" placeholder="کلیک کنید" data-ha-datetimepicker="#solardate" data-ha-dp-issolar="true" data-ha-dp-resultinsolar="true" data-ha-dp-disabletime="true" data-ha-dp-resultformat="{year}/{month}/{day}" required >
                                    @if ($errors->has('submit_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('submit_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-4 control-label">تاریخ شروع کلاس ها </label>
                                <div class="col-md-6" id="">
                                    <input  type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" id="solardate2" placeholder="کلیک کنید" data-ha-datetimepicker="#solardate2" data-ha-dp-issolar="true" data-ha-dp-resultinsolar="true" data-ha-dp-disabletime="true" data-ha-dp-resultformat="{year}/{month}/{day}" required >
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-4 control-label">ظرفیت</label>
                                <div class="col-md-6" id="">
                                    <input id="capacity" type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" required >
                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">آدرس  </label>
                                <div class="col-md-6" id="">
                                    <textarea id="address" type="text" class="form-control" name="address" rows="6" required >{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="dividerDiv"></div>


                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-md-4 col-md-push-3 control-label">توضیحات  </label>
                                <div class="col-md-12" id="">
                                    <textarea id="summernote" type="text" class="form-control" name="desc" cols="500" rows="30"  >{{ old('desc') }}</textarea>
                                @if ($errors->has('desc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="dividerDiv"></div>


                            <div class="col-md-10 col-md-push-1" style="margin-bottom: 50px">
                                <table class="table table-bordered product-table"  id="tbl-list">
                                    <tr class="text-center">
                                        <th class="text-center">زمان برگزاری</th>
                                    </tr>
                                    <tr class="text-center">
                                        <td>
                                            <div class="select-list">
                                                <input type="text" name="times[]" class="form-control" placeholder=" روزهای  برگزاری کلاس ها به همراه ساعت (شنبه و یکشنبه ساعت 17 الی 19)" >
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div style="float: left;">
                                    <button title="اضافه کردن ردیف جدید" type="button" class="btn btn-success btn-add-row" style="box-shadow: 0px 1px 3px 0px #343a40;    margin-left: 40px;margin-top: -18px;">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{!! asset('src/ha-solardate.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('src/ha-datetimepicker.min.js') !!}"></script>

    <script >
        $(".btn-add-row").click(function() {
            var tr1 = $('#tbl-list tr').eq(1).clone(true);
            tr1.find('.btn-del-row').css('display', 'inline-block');
            tr1.find('input[type="text"]').val('');
            tr1.find('select').val('');
            $('#tbl-list').append(tr1);

        });

    </script>
@endsection
@section('footer')
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script>
        $(document).ready(function(){

            $(".summernote").summernote({

                onChange: function () {
                    $('.note-editor').find('textarea').attr('name', 'value');

                    $('.note-codable').text($('.note-editable').html());
                }
            });
            $(".summernote").trigger('summernote.change');

            $('#summernote').summernote({
                height: 200,
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }
            });

            function sendFile(file, editor, welEditable) {
                let data = new FormData();
                data.append("file", file);
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "/upload/photo/summernote",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        editor.insertImage(welEditable, url);
                    }
                });
            }

            document.getElementById("solardate").addEventListener("click", function() {
                $(".ha-datetimepicker-container").css({top: -900});
            });

            document.getElementById("solardate2").addEventListener("click", function() {
                $(".ha-datetimepicker-container").css({top: -900});
            });

        });
    </script>
@endsection
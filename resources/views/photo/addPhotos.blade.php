@extends('layouts.admin')

@section('title')
    {{$site_title}}   |   آپلود عکس پروفایل
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>عکس آپلود شده </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                            <div class="">
                                <div class="">
                                    <div >

                                        @if($item->photo)
                                            <div  class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-lg-offset-3 col-md-6 col-lg-offset-3">
                                                <a href="{{ $item->photo }}">
                                                    <div style="background-position: center;width: 100%;height: 300px;background-size:cover;border-radius: 10px;background-image:url({{url($item->photo )}})">

                                                    </div>
                                                    <form class="deleteForm" method="post" action="{{route('photos.destroyPhoto',['id'=>$item->id])}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button style="position: absolute;bottom: 0px;left: 25px;" class="btn btn-sm btn-danger" type="submit">Delete
                                                        </button>
                                                    </form>
                                                </a>
                                            </div>
                                        @else
                                            <h3>No Photos</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>آپلود عکس </h5>
                    </div>
                    <div class="ibox-content">
                        <form id="my-awesome-dropzone" method="POST" class="dropzone" action="{{route('photos.addPhotos',['id'=>$item->id])}}">
                            {{ csrf_field() }}
                            <div class="dropzone-previews"></div>
                        </form>
                    </div>
                    <div class="col-md-10 col-md-offset-1" style="margin-top: 5px;">
                        <a class="btn btn-success" href="{{route('photos.addPhotosForm',['id'=>$item->id])}}"> آپلود</a>
                        <a class="btn btn-primary" href="{{route('admin.dashboard')}}">تمام</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
    <script>
        $(document).ready(function(){

            Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 10,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }
            }
        });
    </script>
@endsection

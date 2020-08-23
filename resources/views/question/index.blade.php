@extends('layouts.admin')

@section('title')
      {{$site_title}}  | لیست سوال ها
@endsection

@section('test')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست سوال ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>آزمون ها</a>
                </li>
                <li class="active">
                    <strong>لیست سوال ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست سوال ها</h5>
                    </div>
                        {{--<div class="searchListDiv">
                            <input class="form-control searchListInput" id="searchInput" type="text" placeholder="جستجو بر اساس شماره عنوان">
                            <button class="btn btn-primary btn-sm searchListBtn" id="search" >جستجو</button>
                        </div>--}}
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>شماره سوال</th>
                                <th>سوال </th>
                                <th>وضعیت </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{$question->id}}</td>
                                    <td>{{$question->number}}</td>
                                    <td>{{$question->question}}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$question->id}}" onchange="activate({{$question->id}})" name="status" type="checkbox" @if($question->status=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    @can('update')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('question.edit',['question'=>$question->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('question.destroy',['question'=>$question->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    {{--<td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$question->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  سوال: {{$question->question}}</a>
                                                                        <a class="list-group-item">  گزینه1: {{$question->answer1}}</a>
                                                                        <a class="list-group-item">  گزینه2: {{$question->answer2}}</a>
                                                                        <a class="list-group-item">  گزینه3: {{$question->answer3}}</a>
                                                                        <a class="list-group-item">  گزینه4: {{$question->answer4}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <a class="btn btn-sm btn-info"  href="{{ route('question.createNew',['test'=>$test->id ]) }}">افزودن سوال جدید</a>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $questions->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value =$(switchButton).is(":checked")?'on':'off';
            console.log(value)
            $.get(`/active/question/${id}/${value}`,{id: id,value:value}, function(result){
            });
        }
        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            var testId ="{{$test->id}}";
            $.get(`/search/in/questions/{value}/{test_id}`,{value:value,test_id:testId}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection

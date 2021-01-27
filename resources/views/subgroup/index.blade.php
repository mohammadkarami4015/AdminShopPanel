@extends('layouts.admin')

@section('title')
    لیست  زیرگروه ها
@endsection

@section('subgroups')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست زیرگروه ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('subgroup.index')}}">خانه</a>
                </li>
                <li>
                    <a> زیرگروه ها</a>
                </li>
                <li class="active">
                    <strong>لیست زیرگروه ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div
                class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست زیرگروه ها</h5>
                    </div>
                    <div class="searchListDiv">
                        <input onkeyup="Search()" class="form-control searchListInput" id="searchInput" type="text"
                               placeholder=" جستجو بر اساس   نام  " name="data">

                    </div>
                    <div  class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> عنوان</th>
                                <th>نام گروه</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($subgroups as $subgroup)
                                <tr>
                                    <td>{{$subgroup->id}}</td>
                                    <td>{{$subgroup->title}}</td>
                                    <td>{{optional($subgroup->group)->title}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-info "
                                           href="{{ route('subgroup.edit',$subgroup) }}">ویرایش</a>
                                    </td>

                                    <td>
                                        <form class="deleteForm" method="post"
                                              action="{{route('subgroup.destroy',$subgroup)}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">حذف
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $subgroups->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function Search() {
            var value = $('#searchInput').val();
            $.get(`subgroup-search`, {data: value}, function (result) {
                $('#myTable').html(result)
            });
        }


    </script>
@endsection

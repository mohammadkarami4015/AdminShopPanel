<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>وضعیت</th>
    </tr>
    </thead>
    <tbody >
    @foreach($newses as $news)
        <tr>
            <td>{{$news->id}}</td>
            <td>{{$news->title}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$news->id}}" onchange="activate({{$news->id}})" name="status" type="checkbox" @if($news->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('news.destroy',['news'=>$news->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a id="pjax" class="btn btn-sm btn-info" href="{{ route('news.edit',['news'=>$news->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$news->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات خبر</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"> اطلاعات خبر</div>
                                            @if($news->photo)
                                                <div id="myCarousel{{$news->id}}" class="carousel slide" data-ride="carousel">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <div class="item  active ">
                                                            <img src="/{{$news->photo}}" alt="Los Angeles" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="list-group">
                                                <a class="list-group-item">عنوان: {{$news->title}}</a>
                                                <a class="list-group-item">زیر عنوان: {{$news->sub_title}}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">توضیحات</div>
                                            <div class="list-group">
                                                {!! $news->desc !!}
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
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
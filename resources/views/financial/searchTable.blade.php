<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>وضعیت</th>
    </tr>
    </thead>
    <tbody >
    @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$article->id}}" onchange="activate({{$article->id}})" name="status" type="checkbox" @if($article->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('articles.destroy',['article'=>$article->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a id="pjax" class="btn btn-sm btn-info" href="{{ route('articles.edit',['article'=>$article->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$article->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات مقاله</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"> اطلاعات مقاله</div>
                                            @if($article->photo)
                                                <div id="myCarousel{{$article->id}}" class="carousel slide" data-ride="carousel">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <div class="item  active ">
                                                            <img src="/{{$article->photo}}" alt="Los Angeles" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="list-group">
                                                <a class="list-group-item">عنوان: {{$article->title}}</a>
                                                <a class="list-group-item">توضیحات: {{$article->desc}}</a>
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
@if(!$flag)
    <div class="text-center">
        {{ $articles->links() }}
    </div>
@endif

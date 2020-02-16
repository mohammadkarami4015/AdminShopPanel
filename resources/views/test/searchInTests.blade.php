<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>نوع </th>
        <th>وضعیت </th>
    </tr>
    </thead>
    <tbody>
    @foreach($tests as $test)
        <tr>
            <td>{{$test->id}}</td>
            <td>{{$test->title}}</td>
            <td>{{getTestType($test->type)}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$test->id}}" onchange="activate({{$test->id}})" name="status" type="checkbox" @if($test->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('update')
                <td>
                    <a class="btn btn-sm btn-info"  href="{{ route('test.edit',['test'=>$test->id ]) }}">ویرایش</a>
                </td>
            @endcan
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('test.destroy',['test'=>$test->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$test->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            @if($test->photo)
                                                <div id="myCarousel{{$test->id}}" class="carousel slide" data-ride="carousel">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <div class="item  active ">
                                                            <img src="/{{$test->photo}}" alt="Los Angeles" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="list-group">
                                                <a class="list-group-item">  توضیحات: {{$test->desc}}</a>
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
        {{ $tests->links() }}
    </div>
@endif
<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان تست </th>
        <th>عنوان پاسخ </th>
        <th>تیپ</th>
        <th>وضعیت</th>
    </tr>
    </thead>
    <tbody >
    @foreach($results as $result)
        <tr>
            <td>{{$result->id}}</td>
            <td>@if($result->test->title){{$result->test->title}}@endif</td>
            <td>{{$result->title}}</td>
            <td>{{$result->tip}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$result->id}}" onchange="activate({{$result->id}})" name="status" type="checkbox" @if($result->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('result.destroy',['result'=>$result->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a  class="btn btn-sm btn-info" href="{{ route('result.edit',['result'=>$result->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$result->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$result->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">پاسخ</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">پاسخ</div>
                                            <div class="list-group">
                                                <pre class="preCustom">
                                                    {!! $result->value !!}
                                                </pre>
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
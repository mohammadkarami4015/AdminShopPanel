<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>نام</th>
        <th>تلفن </th>
        <th>ایمیل </th>
        <th>وضعیت </th>
    </tr>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
        <tr>
            <td>{{$teacher->id}}</td>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->phone_number}}</td>
            <td>{{$teacher->email}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$teacher->id}}" onchange="activate({{$teacher->id}})" name="status" type="checkbox" @if($teacher->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('teacher.destroy',['teacher'=>$teacher->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a class="btn btn-sm btn-info"  href="{{ route('teacher.edit',['teacher'=>$teacher->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$teacher->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات کاربر</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">عکس</div>
                                            @if($teacher->photo)
                                                <div id="myCarousel{{$teacher->id}}" class="carousel slide" data-ride="carousel">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <div class="item  active ">
                                                            <img src="/{{$teacher->photo}}" alt="Los Angeles" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"> اطلاعات کاربر</div>
                                            <div class="list-group">
                                                <a class="list-group-item">  نام: {{$teacher->name}}</a>
                                                <a class="list-group-item">  کد ملی: {{$teacher->national_id}}</a>
                                                <a class="list-group-item">  شماره کارت: {{$teacher->card_number}}</a>
                                                <a class="list-group-item">  شبا: {{$teacher->sheba}}</a>
                                                <a class="list-group-item">  معرف: {{$teacher->caller}}</a>
                                                <a class="list-group-item"> سطح: {{getLevelOfUser($teacher->level)}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">درباره ی من</div>
                                            <div class="list-group">
                                                <pre class="preCustom">
                                                    {!! $teacher->about_me !!}
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
@if(!$flag)
    <div class="text-center">
        {{ $teachers->links() }}
    </div>
@endif

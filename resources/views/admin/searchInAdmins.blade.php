<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>نام</th>
        <th>ایمیل </th>
        <th>تلفن </th>
        <th>وضعیت </th>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->phone_number}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$admin->id}}" onchange="activate({{$admin->id}})" name="status" type="checkbox" @if($admin->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('update')
                <td>
                    <a class="btn btn-sm btn-info"  href="{{ route('admin.editAdmins',['user'=>$admin->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$admin->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">عکس پروفایل</div>
                                                @if($admin->photo)
                                                    <div id="myCarousel{{$admin->id}}" class="carousel slide" data-ride="carousel">
                                                        <!-- Wrapper for slides -->
                                                        <div class="carousel-inner">
                                                            <div class="item  active ">
                                                                <img src="/{{$admin->photo}}" alt="" style="width:100%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="panel-heading">جزئیات</div>
                                            <div class="list-group">
                                                <a class="list-group-item">  نام: {{$admin->name}}</a>
                                                <a class="list-group-item">  کد ملی: {{$admin->national_id}}</a>
                                                <a class="list-group-item"> نوع: {{getTypeOfUser($admin->type)}}</a>
                                                <a class="list-group-item">  درباره ی من: {{$admin->about_me}}</a>
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
        {{ $admins->links() }}
    </div>
@endif
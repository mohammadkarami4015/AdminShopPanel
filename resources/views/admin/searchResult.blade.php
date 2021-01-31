@foreach($admins as $admin)
    <tr>
        <td>{{$admin->id}}</td>
        <td>{{$admin->name}}</td>
        <td>{{$admin->last_name}}</td>
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
        <td>
            <a class="btn btn-sm btn-info"  href="{{ route('admin.edit',$admin) }}">ویرایش</a>
        </td>
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
                                        <div class="panel-heading">جزئیات</div>
                                        <div class="list-group">
                                            <a class="list-group-item">  نام: {{$admin->name}}</a>
                                            <a class="list-group-item">  نام خانوادگی: {{$admin->last_name}}</a>
                                            <a class="list-group-item">  شماره تماس: {{$admin->phone_number}}</a>
                                            <a class="list-group-item"> وضعیت: {{$admin->status == 'on' ? 'فعال' : 'غیرفعال'}}</a>
                                            <a class="list-group-item">  ایمیل: {{$admin->email}}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">نقش ها</div>
                                            <div class="list-group">
                                                @foreach($admin->roles as $role)
                                                    <a class="list-group-item">
                                                        <b>نام: </b>  {{$role->name}}
                                                        <b style="margin-right: 30px">توضیحات: </b> {{$role->label}}
                                                    </a>
                                                @endforeach
                                            </div>
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

@foreach($roles as $role)
    <tr>
        <td>{{$role->id}}</td>
        <td>{{$role->name}}</td>
        <td>{{$role->label}}</td>
        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('role.edit',$role) }}">ویرایش</a>
        </td>

        <td>
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModalCenter{{$role->id}}">
                جزئیات
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter{{$role->id}}" tabindex="-1"
                 role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <a class="list-group-item">
                                                نام: {{$role->name}}</a>
                                            <a class="list-group-item">
                                                توضیحات: {{$role->label}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">دسترسی ها</div>
                                        <div class="list-group">
                                            @foreach($role->permissions as $permission)
                                                <a class="list-group-item">
                                                    <b>نام: </b>  {{$permission->name}}



                                                    <b style="margin-right: 30px">توضیحات: </b> {{$permission->label}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </td>

        <td>
            <form class="deleteForm" method="post"
                  action="{{route('role.destroy',$role)}}">
                {{method_field('DELETE')}}
                @csrf
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>

    </tr>
@endforeach

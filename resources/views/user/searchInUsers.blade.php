
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
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->phone_number}}</td>
            <td>{{$user->email}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$user->id}}" onchange="activate({{$user->id}})" name="status" type="checkbox" @if($user->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('user.destroy',['user'=>$user->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a class="btn btn-sm btn-info"  href="{{ route('user.edit',['user'=>$user->id ]) }}">ویرایش</a>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$user->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات کاربر</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"> اطلاعات کاربر</div>
                                            <div class="list-group">
                                                <a class="list-group-item">  نام: {{$user->name}}</a>
                                                <a class="list-group-item">  کد ملی: {{$user->national_id}}</a>
                                                <a class="list-group-item">  شماره کارت: {{$user->card_number}}</a>
                                                <a class="list-group-item">  شبا: {{$user->sheba}}</a>
                                                <a class="list-group-item">  معرف: {{$user->caller}}</a>
                                                <a class="list-group-item"> سطح: {{getLevelOfUser($user->level)}}</a>
                                                <a class="list-group-item">  درباره ی من: {{$user->about_me}}</a>
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
        {{ $users->links() }}
    </div>
@endif

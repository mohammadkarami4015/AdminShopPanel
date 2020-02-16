<table class="table table-responsive" >
    <thead>
    <tr>
        <th>#</th>
        <th>نام کاربر </th>
        <th>عنوان </th>
        <th>تلفن کاربر </th>
    </tr>
    </thead>
    <tbody >
    @foreach($messages as $message)
        <tr>
            <td>{{$message->id}}</td>
            <td>{{$message->name}}</td>
            <td>{{$message->title}}</td>
            <td>{{$message->phone_number}}</td>
            @if($message->read_at == null)
                <td>
                    <a id="read_button{{$message->id}}" onclick="read({{$message->id}});" class="btn btn-sm btn-info">بررسی شد</a>
                </td>
            @endif
            @if($message->read_at !== null)
                <td>
                    <a class="btn btn-sm btn-white disabled">بررسی شده</a>
                </td>
            @endif
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$message->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <a class="list-group-item">نام کاربر: {{$message->name}}</a>
                                                <a class="list-group-item">عنوان: {{$message->title}}</a>
                                                <a class="list-group-item">تلفن کاربر: {{$message->phone_number}}</a>
                                                <a class="list-group-item">پیام: {{$message->message}}</a>
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
        {{ $messages->links() }}
    </div>
@endif

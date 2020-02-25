<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>نام</th>
        <th>نوع پرداخت</th>
        <th>شماره کارت / شبا</th>
        <th>شماره درخواست</th>
        <th>مبلغ</th>
        <th>پرداخت کننده</th>
        <th>تاریخ</th>
    </tr>
    </thead>
    <tbody >
    @foreach($clearings as $clearing)
        <tr>
            <td>{{$clearing->id}}</td>
            <td>@if($clearing->financial->user){{$clearing->financial->user->name}}@endif</td>
            <td>@if($clearing->type=="1"){{"شبا"}} @else {{ "کارت به کارت" }} @endif</td>
            <td>@if($clearing->type=="1"){{$clearing->sheba}} @else {{ $clearing->card_number }} @endif</td>
            <td>{{$clearing->payment_request_id}}</td>
            <td>{{$clearing->amount}}</td>
            <td>@if($clearing->user){{$clearing->user->name}}@endif</td>
            <td>{{jalaliFormat($clearing->created_at)}}</td>
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('clearing.destroy',['clearing'=>$clearing->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            @can('update')
                <td>
                    <a  class="btn btn-sm btn-info" href="{{ route('clearing.edit',['clearing'=>$clearing->id ]) }}">ویرایش</a>
                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
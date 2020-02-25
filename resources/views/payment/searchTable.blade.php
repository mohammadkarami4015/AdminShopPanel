<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>کاربر</th>
        <th>عنوان تست</th>
        <th>نام دوره</th>
        <th>مبلغ</th>
        <th>مبلغ پرداخت شده</th>
        <th>وضعیت پرداخت</th>
        <th>تاریخ</th>
    </tr>
    </thead>
    <tbody >
    @foreach($payments as $payment)
        <tr class="@if($payment->status=='success') successPayment @else failedPayment @endif">
            <td>{{$payment->id}}</td>
            <td>@if($payment->user){{$payment->user->name}}@endif</td>
            <td>@if($payment->test){{$payment->test->title}}@endif</td>
            <td>@if($payment->presentCourse){{$payment->presentCourse->course->title}}@endif</td>
            <td>{{$payment->amount}}</td>
            <td>{{$payment->paid_amount}}</td>
            <td>@if($payment->status=='success'){{"پرداخت موفق"}} @else  {{'پرداخت ناموفق'}} @endif</td>
            <td>{{jalaliFormat($payment->created_at)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
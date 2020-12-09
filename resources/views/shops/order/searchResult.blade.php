@foreach($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{optional($order->user)->name}}</td>
        <td>{{$order->total_price}}</td>
        <td>{{$order->address}}</td>
        <td>{{orderStatus($order->order_status)}}</td>

        <td>
            <a class="btn btn-sm btn-primary"
               href="{{ route('order.show',[$shop,$order]) }}">جزییات</a>
        </td>

        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('order.edit',[$shop,$order]) }}">ویرایش</a>
        </td>


    </tr>
@endforeach

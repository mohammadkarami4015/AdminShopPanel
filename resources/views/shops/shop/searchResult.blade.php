@foreach($shops as $shop)
    <tr>
        <td>{{$shop->id}}</td>
        <td>{{$shop->title}}</td>
        <td>{{$shop->address}}</td>
        <td>{{$shop->phone_number}}</td>
        <td>
            <div class="switch">
                <label>
                    <input id="switchButton{{$shop->id}}" onchange="activate({{$shop->id}})"
                           name="status" type="checkbox"
                           @if($shop->admin_verification=='on')checked @endif >
                    <span class="lever"></span>
                </label>
            </div>
        </td>

        <td>
            <a class="btn btn-sm btn-info" href="{{route('shop.details',$shop)}}">
                جزئیات</a>
        </td>

        <td>
            <form class="deleteForm" method="post"
                  action="{{ route('shop.delete',$shop) }}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>


    </tr>
@endforeach

@foreach($shopCategories as $shopCategory)
    <tr>
        <td>{{$shopCategory->id}}</td>
        <td>{{$shopCategory->title}}</td>
        <td>{{$shopCategory->status == 'on'? 'فعال' : 'غیرفعال'}}</td>

        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('shopCategory.edit',[$shop,$shopCategory]) }}">ویرایش</a>
        </td>


        <td>
            <form class="deleteForm" method="post"
                  action="{{route('shopCategory.destroy',[$shop,$shopCategory])}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-sm btn-danger" type="submit"> حذف
                </button>
            </form>
        </td>
    </tr>
@endforeach

@foreach($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{{optional($product->shopCategory)->title}}</td>
        <td>{{$product->inventory}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->status=='on' ? 'فعال' : 'غیر فعال'}}</td>
        <td>
            <form class="deleteForm" method="post"
                  action="{{ route('product.destroy',[$shop,$product]) }}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>


        <td>
            <a class="btn btn-sm btn-info" href="{{ route('product.edit',[$shop,$product]) }}">ویرایش</a>
        </td>

        <td>
            <a class="btn btn-sm btn-primary"
               href="{{ route('productComment.index',[$shop,$product]) }}">کامنت ها</a>
        </td>

        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('product.show',[$shop,$product]) }}"> جزئیات</a>
        </td>


    </tr>
@endforeach

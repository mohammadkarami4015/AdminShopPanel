@foreach($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{{optional($product->shop)->title}}</td>
        <td>{{optional($product->shopCategory)->title}}</td>
        <td>{{$product->inventory}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->status=='on' ? 'فعال' : 'غیر فعال'}}</td>

        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('products.show',$product)}}"> جزئیات</a>
        </td>

    </tr>
@endforeach

@foreach($cities as $city)
    <tr>
        <td>{{$city->id}}</td>
        <td>{{$city->title}}</td>
        <td>{{optional($city->country)->title}}</td>

        <td>
            <div class="switch">
                <label>
                    <input id="switchButton{{$city->id}}" onchange="activate({{$city->id}})"
                           name="status" type="checkbox"
                           @if($city->status=='on')checked @endif >
                    <span class="lever"></span>
                </label>
            </div>
        </td>

        <td>
            <a class="btn btn-sm btn-info "
               href="{{ route('city.edit',$city) }}">ویرایش</a>
        </td>

        <td>
            <form class="deleteForm" method="post"
                  action="{{route('city.destroy',$city)}}">
                {{method_field('DELETE')}}
                @csrf
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>


    </tr>
@endforeach

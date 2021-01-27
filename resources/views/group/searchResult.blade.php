@foreach($groups as $group)
    <tr>
        <td>{{$group->id}}</td>
        <td>{{$group->title}}</td>
        <td>
            <div class="switch">
                <label>
                    <input id="switchButton{{$group->id}}"
                           onchange="activate({{$group->id}})"
                           name="status" type="checkbox"
                           @if($group->status=='on')checked @endif >
                    <span class="lever"></span>
                </label>
            </div>
        </td>

        <td>
            <a class="btn btn-sm btn-info"
               href="{{ route('group.edit',$group) }}">ویرایش</a>
        </td>

        <td>
            <form class="deleteForm" method="post"
                  action="{{route('group.destroy',$group)}}">
                {{method_field('DELETE')}}
                @csrf
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>

    </tr>
@endforeach

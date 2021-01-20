@foreach($subgroups as $subgroup)
    <tr>
        <td>{{$subgroup->id}}</td>
        <td>{{$subgroup->title}}</td>
        <td>{{optional($subgroup->group)->title}}</td>

        <td>
            <a class="btn btn-sm btn-info "
               href="{{ route('subgroup.edit',$subgroup) }}">ویرایش</a>
        </td>

        <td>
            <form class="deleteForm" method="post"
                  action="{{route('subgroup.destroy',$subgroup)}}">
                {{method_field('DELETE')}}
                @csrf
                <button class="btn btn-sm btn-danger" type="submit">حذف
                </button>
            </form>
        </td>


    </tr>
@endforeach

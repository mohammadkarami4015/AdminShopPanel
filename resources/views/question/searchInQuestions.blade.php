<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>سوال </th>
        <th>وضعیت </th>
    </tr>
    </thead>
    <tbody>
    @foreach($questions as $question)
        <tr>
            <td>{{$question->id}}</td>
            <td>{{$question->title}}</td>
            <td>{{$question->question}}</td>
            <td>
                <div class="switch">
                    <label>
                        <input id="switchButton{{$question->id}}" onchange="activate({{$question->id}})" name="status" type="checkbox" @if($question->status=='on')checked @endif >
                        <span class="lever"></span>
                    </label>
                </div>
            </td>
            @can('update')
                <td>
                    <a class="btn btn-sm btn-info"  href="{{ route('question.edit',['question'=>$question->id ]) }}">ویرایش</a>
                </td>
            @endcan
            @can('delete')
                <td>
                    <form class="deleteForm" method="post" action="{{ route('question.destroy',['question'=>$question->id ]) }}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger" type="submit">حذف
                        </button>
                    </form>
                </td>
            @endcan
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$question->id}}">
                    جزئیات
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">جزئیات</div>
                                            <div class="list-group">
                                                <a class="list-group-item">  سوال: {{$question->question}}</a>
                                                <a class="list-group-item">  گزینه1: {{$question->answer1}}</a>
                                                <a class="list-group-item">  گزینه2: {{$question->answer2}}</a>
                                                <a class="list-group-item">  گزینه3: {{$question->answer3}}</a>
                                                <a class="list-group-item">  گزینه4: {{$question->answer4}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if(!$flag)
    <div class="text-center">
        {{ $questions->links() }}
    </div>
@endif
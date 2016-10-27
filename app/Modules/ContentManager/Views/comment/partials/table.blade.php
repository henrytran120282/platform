<table class="table table-striped jambo_table bulk_action"> 
    <thead>
        <tr> 
            <th><input id="checkAll" type="checkbox" class="flat"></th>
            <th>Author</th> 
            <th>Detail</th> 
            <th>Post</th> 
        </tr> 
    </thead> 
    <tbody>
        @foreach ($model as $data)
        <tr id="tr-{{ $data->id }}"> 
            <td style="width:50px">
                <input type="checkbox" name="checkbox" class="flat" data-role="checkbox" value="{{$data->id}}" /> 
                <input type="hidden" id="idPost" value="{{ $data->term_id }}">
            </td>
            <td style="width:100px"><img src="{{$data->getAvatar()}}" class="img img-responsive" /></td> 
            <td style="max-width:350px">
                <div class="comment-td">
                    <div class="meta-comment">
                        <span><i class="fa fa-user"></i> {{ $data->author }}</span>
                        <span><i class="fa fa-calendar"></i> {{ $data->updated_at->format('M d, Y') }}</span>
                        <span><i class="fa fa-envelope"></i> {{ $data->email }}</span>
                    </div>
                    {{$data->content}}
                    <div class="btn-edit-delete">
                        <a href="{{ Admin::route('contentManager.comment.approve',['comment'=>$data->id]) }}" > 
                            {{ ($data->approved) ? "Unapprove " : "Approve " }}
                        </a> | 
                        <a href="#" data-role="delete-post" data-url="{{ Admin::route('contentManager.comment.destroy',['category'=>'']) }}/" data-idpost="{{ $data->id }}" > Delete </a>
                    </div>
                </div>
            </td> 
            <td>{{ $data->post->post_title }}</td> 
        </tr> 
        @endforeach  
    </tbody> 
</table>
{{ $model->links() }}
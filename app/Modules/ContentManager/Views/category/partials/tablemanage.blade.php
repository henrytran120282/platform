<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-8">
                <h3 class="panel-title">Category</h3>
            </div>
            <div class="col-md-4 text-right">
                <a id="btn-sel-del" style="display:none;" data-url="{{ Admin::route('contentManager.category.destroy',['category'=>'']) }}/" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Selected post</a>
            </div>
        </div>
    </div>
  </div>
  <div class="panel-body">
    <table class="table table-striped jambo_table bulk_action"> 
        <thead>
            <tr> 
                <th><input id="checkAll" type="checkbox" class="flat"></th>
                <th>Name</th> 
                <th>Desciption</th> 
                <th>Slug</th> 
            </tr> 
        </thead> 
        <tbody>
            @foreach ($model as $data)
            <tr id="tr-{{ $data->term_id }}"> 
                <td>
                    <input type="checkbox" name="checkbox" class="flat" data-role="checkbox" value="{{$data->term_id}}" /> 
                    <input type="hidden" id="idPost" value="{{ $data->term_id }}">
                </td>
                <td>
                    <div class="">
                        {{$data->name}}
                        <div class="btn-edit-delete">
                            <a href="{{ Admin::route('contentManager.category.edit',['post'=>$data->term_id]) }}" > Edit </a> | 
                            <a href="#" data-role="delete-post" data-url="{{ Admin::route('contentManager.category.destroy',['category'=>'']) }}/" data-idpost="{{ $data->term_id }}" > Delete </a>
                        </div>
                    </div>
                </td> 
                <td>{{$data->description}}</td> 
                <td>{{$data->slug}}</td> 
            </tr> 
            @endforeach  
        </tbody> 
    </table>
    {{ $model->links() }}
  </div>
</div>
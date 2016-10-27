<table class="table table-striped jambo_table bulk_action"> 
  <thead>
    <tr> 
      <th><input id="checkAll" type="checkbox" class="flat"></th>
      <th>Name</th> 
      <th>Desciption</th> 
    </tr> 
  </thead> 
  <tbody>
    @foreach ($model as $data)
    <tr id="tr-{{ $data->id }}"> 
      <td>
          <input type="checkbox" class="flat" name="checkbox" data-role="checkbox" value="{{$data->id}}" /> 
          <input type="hidden" id="idPost" value="{{ $data->id }}">
      </td>
      <td>
          <div class="btn-edit-delete">
              {{$data->name}}
              <div class="">
                  <a href="{{ Admin::route('contentManager.user.edit',['user'=>$data->id]) }}" > Edit </a> | 
                  <a href="#" data-role="delete-post" data-idpost="{{ $data->id }}" data-url="{{ Admin::route('contentManager.user.destroy',['tag'=>'']) }}/" > Delete </a>
              </div>
          </div>
      </td> 
      <td>{{$data->description}}</td> 
    </tr> 
    @endforeach  
  </tbody> 
</table>
{{ $model->links() }}
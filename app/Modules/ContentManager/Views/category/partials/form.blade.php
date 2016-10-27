<form  method="POST" action="{{ ($model != "") ? Admin::route('contentManager.category.update',['category'=>$model->term_id]) : Admin::route('contentManager.category.store') }}">
  {{ csrf_field() }}
  @if($model != "")
  <input name="_method" type="hidden" value="PUT">
  @endif
  <div class="form-group">
    <label for="name-category">Name *</label>
    <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->name : old('name') }}" name="name" id="name-category" placeholder="Name Category">
  </div>
  <div class="form-group">
    <label for="slug-category">Slug</label>
    <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->slug : old('slug') }}" name="slug" id="slug-category" placeholder="Slug Category">
  </div>
  <div class="form-group">
    <label for="parent-category">parent</label>
    <select class="form-control"  name="parent" id="parent-category">
      <option value="0">Select Parent</option>
          @foreach($category as $node)
            @if(count($node->children()) > 0 )
              @include('ContentManager::partials.categoryoption', ['datas' => $node->children(),'select'=>($model != "" ) ? $model->parent : 0])  
            @endif
          @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="desctiption-category">Description</label>
    <textarea class="form-control" name="description" rows="3">{{ ($model != "" ) ? $model->description : old('description') }}</textarea>
  </div>
  @if($model != "")
  <button type="submit" class="btn btn-default">Save</button>
  <a href="{{ Admin::route('contentManager.category.index') }}" class="btn btn-warning">Cencel</a>
  @else
  <button type="submit" class="btn btn-default">Create</button>
  @endif
</form>


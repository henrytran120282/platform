<form  method="POST" action="{{ ($model != "") ? Admin::route('contentManager.tag.update',['post'=>$model->term_id]) : Admin::route('contentManager.tag.store') }}">
  {{ csrf_field() }}
  @if($model != "")
  <input name="_method" type="hidden" value="PUT">
  @endif
  <div class="form-group">
    <label for="name-tag">Name *</label>
    <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->name : old('name') }}" name="name" id="name-tag" placeholder="Name Tag">
  </div>
  <div class="form-group">
    <label for="slug-tag">Slug</label>
    <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->slug : old('slug') }}" name="slug" id="slug-category" placeholder="Slug Tag">
  </div>
  <div class="form-group">
    <label for="desctiption-tag">Description</label>
    <textarea class="form-control" name="description" rows="3">{{ ($model != "" ) ? $model->description : old('description') }}</textarea>
  </div>
  @if($model != "")
  <button type="submit" class="btn btn-default">Save</button>
  <a href="{{ Admin::route('contentManager.tag.index') }}" class="btn btn-warning">Cencel</a>
  @else
  <button type="submit" class="btn btn-default">Create</button>
  @endif
</form>

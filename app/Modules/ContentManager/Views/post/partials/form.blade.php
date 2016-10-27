<form method="POST" action="{{ ($model != "") ? Admin::route('contentManager.post.update',['post'=>$model->id]) : Admin::route('contentManager.post.store') }}">
  <div class="col-md-9">
    {{ csrf_field() }}
    @if($model != "")
    <input name="_method" type="hidden" value="PUT">
    <?php $val = array() ?>
    @foreach($tags as $tag)
      @if($tag->terms->taxonomy == "tag")
      <?php $val[] = $tag->terms->name ?>
      @endif
    @endforeach
    @endif
    <div class="form-group">
        <label for="title-post">Title Post</label>
        <input type="text" class="form-control" name="post_title" value="{{ ($model != "" ) ? $model->post_title : old('post_title') }}" id="title-post" placeholder="Title Post">
        @if($model != "")
        <p class="help-block"><strong>Permalink : </strong><span id="slug-permalink">{{ Url('/') }}/{{ $model->post_name }}</span></p>
        @endif
    </div>
    <div class="form-group">
        <label for="content-post">Content</label>
        <textarea id="content-post" name="post_content" class="form-control" rows="18">{{ ($model != "" ) ? Helper::bbcode($model->post_content) : old('post_content') }}</textarea>
    </div>
    <div class="form-group">
        <label for="content-post">Post Excerpt</label>
        <textarea id="post-excerpt" name="post_excerpt" class="form-control" rows="5">{{ ($model != "" ) ? $model->post_excerpt : old('post_excerpt') }}</textarea>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">Publish</div>
      <div class="panel-body">
        <button type="submit" class="btn btn-success btn-block">{{ ($model != "" ) ? "Save Post" : "Publish Post" }}</button> 
      </div>
      <ul class="list-group">
        @if($model != "")
        <li class="list-group-item"><i class="fa fa-calendar"></i> Create at : {{ $model->created_at->format("d F Y") }}</li>
        <li class="list-group-item"><i class="fa fa-calendar"></i> Update at : {{ $model->updated_at->format("d F Y") }}</li>
        @else
        <li class="list-group-item"><i class="fa fa-calendar"></i> Create at : {{ date("d F Y") }}</li>
        @endif
        <li class="list-group-item"><i class="fa fa-user"></i> Author : {{ Auth::guard('admin')->user()->name }}</li>
        @if($model != "")
        <li class="list-group-item">
          <select name="status" class="form-control">
            <option {{ ($model->post_status == "publish") ? "selected" : "" }} value="publish">Publish</option>
            <option {{ ($model->post_status == "Draft") ? "selected" : "" }} value="Draft">Draft</option>
          </select>
        </li>
        @else
        <li class="list-group-item">
          <select name="status" class="form-control">
            <option value="publish">Publish</option>
            <option value="Draft">Draft</option>
          </select>
        </li>
        @endif 
        @if($model != "")
        <li class="list-group-item">
          <select name="comment_status" class="form-control">
            <option {{ ($model->comment_status == "open") ? "selected" : "" }} value="open">Open Comment</option>
            <option {{ ($model->comment_status == "close") ? "selected" : "" }} value="close">Close Comment</option>
          </select>
        </li>
        @else
        <li class="list-group-item">
          <select name="comment_status" class="form-control">
            <option value="open">Open Comment</option>
            <option value="close">Close Comment</option>
          </select>
        </li>
        @endif         
      </ul>
    </div>
    <div class="featured-post">
      <label>
        <div class="labelFeaturedPost">
        Featured Post 
        </div>
          <input type="checkbox" class="js-switch" name="meta[featured_post]" {{ ($model != "" ) ? ($model->getMetaValue('featured_post') ? "checked" : ""  ) : old('meta[featured_img]') }} /> 
      </label>
      <div class="clearfix"></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Categories</div>
      <div class="panel-body list-category">
         <ul id="parent-0" class="list-unstyled category-list-scroll">
            @foreach($category as $node)
                @if(count($node->children()) > 0 )
                  @include('ContentManager::post.partials.categorylist', ['datas' => $node->children(),'post'=>($model != "" ) ? $model->id : false])  
                @endif
            @endforeach
        </ul>
        <a id="btn-add-category" class="btn btn-success btn-sm btn-block" href="#"> + Add Category</a>
        <div id="input-category">
           <div class="form-group">
            <label for="name-category">Name Category</label>
            <input type="text" class="form-control" id="name-category" placeholder="Name Category">
          </div>
          <div class="form-group">
            <label for="parent-category">Parent</label>
            <select class="form-control" id="parent-category">
              <option value="0">Select Parent</option>
                  @foreach($category as $node)
                    @if(count($node->children()) > 0 )
                      @include('ContentManager::partials.categoryoption', ['datas' => $node->children(),'select'=>($model != "" ) ? $model->parent : 0])  
                    @endif
                  @endforeach
            </select>
          </div>
          <a href="#" id="add-category" class="btn btn-default btn-sm">Add Category</a>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Tags</div>
      <div class="panel-body">
        <input type="text" class="form-control" name="tags" id="tags" value="{{ ($model != "" ) ? implode(',',$val) : old('tags') }}" data-role="tagsinput" >
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Featured Image</div>
      <div class="panel-body">
        @include('ContentManager::partials.inputBtnUpload',['idModal'=>'featuredImage','setInput'=>'meta_featured_img']) 
      </div>
    </div>
  </div>
</form>






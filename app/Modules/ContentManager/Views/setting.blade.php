@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="x_panel">
    <div class="x_title">
      <h2>Settings</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    @include('ContentManager::partials.errormessage')
    @if (session('status'))
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p><i class="fa fa-check"></i> {{ session('status') }}</p>
      </div>
    @endif
      <form action="{{ Admin::route('contentManager.setting.update') }}" method="POST">
        {{ csrf_field() }}
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="general-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="post-tab" data-toggle="tab" aria-expanded="false">Post</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="media-tab2" data-toggle="tab" aria-expanded="false">Media</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="general-tab">
                  
                  <div class="form-group">
                    <label for="site-title">Site Title</label>
                    <input type="text" name="opt[site_title]" class="form-control" value="{{ $model['site_title'] }}" id="site-title" placeholder="Site Title">
                  </div>
                  <div class="form-group">
                    <label for="site-tagline">Site Tagline</label>
                    <input type="text" name="opt[site_tagline]" class="form-control" value="{{ $model['site_tagline'] }}" id="site-tagline" placeholder="Site Tagline">
                  </div>
                  <div class="form-group">
                    <label for="email_administrator">Email Administrator</label>
                    <input type="text" name="opt[email_administrator]" class="form-control" value="{{ $model['email_administrator'] }}" id="email_administrator" placeholder="Email Administrator">
                  </div>
                  <button type="submit" class="btn btn-default">Save</button>
                
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="post-tab">

                <div class="form-group">
                    <label for="frontpage_blog">Post On Frontpage</label>
                    <select class="form-control" name="opt[frontpage_blog]" id="frontpage_blog">
                      <option {{ ($model['frontpage_blog'] == "0") ? "selected" : "" }} value="0">False</option>
                      <option {{ ($model['frontpage_blog'] == "1") ? "selected" : "" }} value="1">True</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="view_post_index">Post View</label>
                    <input type="text" name="opt[view_post_index]" class="form-control" value="{{ $model['view_post_index'] }}" id="view_post_index" placeholder="Site Tagline">
                  </div>
                  <button type="submit" class="btn btn-default">Save</button>

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="media-tab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_thumbnail_width">Thumbnail Width</label>
                      <input type="text" name="opt[image_thumbnail_width]" class="form-control" value="{{ $model['image_thumbnail_width'] }}" id="image_thumbnail_width" placeholder="Site Title">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_thumbnail_height">Thumbnail Height</label>
                      <input type="text" name="opt[image_thumbnail_height]" class="form-control" value="{{ $model['image_thumbnail_height'] }}" id="image_thumbnail_height" placeholder="Site Tagline">
                    </div> 
                  </div>  
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_medium_width">Medium Width</label>
                      <input type="text" name="opt[image_medium_width]" class="form-control" value="{{ $model['image_medium_width'] }}" id="image_medium_width" placeholder="Site Title">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_medium_height">Medium Height</label>
                      <input type="text" name="opt[image_medium_height]" class="form-control" value="{{ $model['image_medium_height'] }}" id="image_medium_height" placeholder="Site Tagline">
                    </div> 
                  </div>  
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_large_width">Large Width</label>
                      <input type="text" name="opt[image_large_width]" class="form-control" value="{{ $model['image_large_width'] }}" id="image_large_width" placeholder="Site Title">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image_large_height">Large Height</label>
                      <input type="text" name="opt[image_large_height]" class="form-control" value="{{ $model['image_large_height'] }}" id="image_large_height" placeholder="Site Tagline">
                    </div> 
                  </div>  
                </div>
                
                
                  <button type="submit" class="btn btn-default">Save</button>

              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection
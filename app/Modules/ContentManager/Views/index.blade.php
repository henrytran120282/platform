@extends(Admin::theme())

@section('content')
<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file-o"></i></div>
      <div class="count">{{ $post }}</div>
      <h3>Posts</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-columns"></i></div>
      <div class="count">{{ $page }}</div>
      <h3>Pages</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
      <div class="count">{{ $category }}</div>
      <h3>Categories</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-comments-o"></i></div>
      <div class="count">{{ $comment }}</div>
      <h3>Comments</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
</div>

@endsection
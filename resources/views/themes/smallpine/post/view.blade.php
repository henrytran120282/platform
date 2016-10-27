@extends(Theme::active().'.main')

@section('content')
<div class="SStyle2">
<article id="post-{{$model->id}}" class="post-{{$model->id}} post">
  <div class="post-inner">
    <header class="entry-header">
      <div class="featured-img">
          <img src="{{ $model->getMetaValue('featured_img') }}" class="img-responsive" alt="{{ $model->post_title }}">  
          <div class="prespec"></div>
      </div>
      <div class="block-meta">
        <div class="entry-categories">
          <span class="cat-links">
            {!! Helper::taxonomyLink($model->categories) !!}         
          </span>
        </div><!-- .entry-meta -->
        <h2 class="post-title">
          <a href="{{ $model->getUrl() }}" rel="bookmark">
            {{ $model->post_title }}
          </a>
        </h2>     
        <div class="post-meta">
          <span class="posted-on"><i class="fa fa-calendar"></i> <a href="{{ $model->getUrl() }}" rel="bookmark"><time class="entry-date published updated" datetime="2016-09-19T15:16:06+00:00">{{ $model->updated_at->format('M d, Y') }}</time></a></span>
          <span class="byline"> by <span class="author vcard"><a class="url fn n" href="#">{{ $model->user->name }}</a></span></span>
          <span class="comments-link"><i class="fa fa-comment"></i> <a href="{{ $model->getUrl() }}">{{ $model->comments->count() }} Comment</a></span>   
        </div>  
      </div>
    </header><!-- .entry-header -->

    <div class="entry-content">
      {!!html_entity_decode($model->post_content)!!}
    </div><!-- .entry-content -->

    <footer class="entry-footer">
      <div class="footer-blog">
        <div class="btn-group" role="group" aria-label="...">
          
        </div>
      </div>  
    </footer><!-- .entry-footer -->
  </div>
</article><!-- #post-## -->
<div class="row">
  <div class="col-md-6">
    @include('ContentManager::post.partials.prevpost')
  </div>
  <div class="col-md-6">
    @include('ContentManager::post.partials.nextpost')
  </div>
</div>
@if($model->comment_status == "open")
@include('ContentManager::partials.errormessage')
<h2 id="comments" class="page-header">Comments</h2>
<section class="comment-list">
    <form method="POST" action="{{url('/'.$model->post_name.'/addcomment')}}">
    {{ csrf_field() }}
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="comment-name">Name *</label>
            <input type="text" name="comment_name" class="form-control" id="comment-name" placeholder="Name">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="comment-email">Email *</label>
            <input type="text" name="comment_email" class="form-control" id="comment-email" placeholder="Email">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="comment-website">Website</label>
            <input type="text" name="comment_website" class="form-control" id="comment-website" placeholder="Website">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="comment-content">Comment *</label>
        <textarea class="form-control" name="comment_content" id="comment-name" rows="9"></textarea>
      </div>
      <div class="text-left">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
    @include(Theme::active().'.post.comments')
</section>
@endif
</div>
@endsection


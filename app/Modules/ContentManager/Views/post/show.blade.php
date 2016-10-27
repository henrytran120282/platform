@extends(Theme::active().'.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $model->post_title }}</h1>
        <div class="well well-sm">
			<span><i class="fa fa-clock-o"></i> {{ $model->updated_at->format('M d, Y') }}</span> | 
			<span><i class="fa fa-user"></i> {{ $model->user->name }}</span> |
			<span><i class="fa fa-comment"></i> {{ $model->comments->count() }} Comments</span> 
		</div>
    {!!html_entity_decode($model->post_content)!!}
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
</div>
@endsection


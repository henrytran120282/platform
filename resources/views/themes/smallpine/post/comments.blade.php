@foreach($model->comments as $comment)
<article class="row">
    <div class="col-md-2 col-sm-2 hidden-xs">
      <figure class="thumbnail">
        <img class="img-responsive" src="{{ $comment->getAvatar() }}" />
        <figcaption class="text-center">{{ $comment->author }}</figcaption>
      </figure>
    </div>
    <div class="col-md-10 col-sm-10">
      <div class="panel panel-default arrow left">
        <div class="panel-body">
          <header class="text-left">
            <div class="comment-user"><i class="fa fa-user"></i> {{ $comment->author }}</div>
            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{ $comment->updated_at->format('M d, Y') }}</time>
          </header>
          <div class="comment-post">
            {!! $comment->content !!}
          </div>
          <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
        </div>
      </div>
    </div>
</article>
@endforeach
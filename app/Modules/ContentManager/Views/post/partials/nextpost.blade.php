@if($nextPost != null)
Next Post
<a href="{{ $nextPost->getUrl() }}"><h3>{{ $nextPost->post_title }}</h3></a>
@endif
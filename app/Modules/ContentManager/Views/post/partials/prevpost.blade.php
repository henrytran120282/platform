@if($prevPost != null)
Prev Post
<a href="{{ $prevPost->getUrl() }}"><h3>{{ $prevPost->post_title }}</h3></a>
@endif
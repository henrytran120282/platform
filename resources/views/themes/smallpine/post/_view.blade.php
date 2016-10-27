<article id="post-{{$data->id}}" class="post-{{$data->id}} post">
	<div class="post-inner">
		<header class="entry-header">
			<div class="featured-img">
				<a href='{{ $data->getUrl() }}'>
					<img src="{{ $data->getMetaValue('featured_img') }}" class="img-responsive" alt="{{ $data->post_title }}">	
					<div class="prespec"></div>
				</a>
			</div>
			<div class="block-meta">
				<div class="entry-categories">
					<span class="cat-links">
						{!! Helper::taxonomyLink($data->categories) !!}					
					</span>
				</div><!-- .entry-meta -->
				<h2 class="post-title">
					<a href="{{ $data->getUrl() }}" rel="bookmark">
						{{ $data->post_title }}
					</a>
				</h2>			
				<div class="post-meta">
					<span class="posted-on"><i class="fa fa-calendar"></i> <a href="{{ $data->getUrl() }}" rel="bookmark"><time class="entry-date published updated" datetime="2016-09-19T15:16:06+00:00">{{ $data->updated_at->format('M d, Y') }}</time></a></span>
					<span class="byline"> by <span class="author vcard"><a class="url fn n" href="#">{{ $data->user->name }}</a></span></span>
					<span class="comments-link"><i class="fa fa-comment"></i> <a href="{{ $data->getUrl() }}">{{ $data->comments->count() }} Comment</a></span>		
				</div>	
			</div>
			
		</header><!-- .entry-header -->

		<div class="entry-content">
			{!! $data->getExcerpt() !!}
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="footer-blog">
				<div class="btn-group" role="group" aria-label="...">
					<a href="{{ $data->getUrl() }}" class="btn btn-read-more">Continue Reading...</a>
				</div>
			</div>	
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->



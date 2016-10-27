<div class="row">
	<aside id="sidebar" class="col-md-3" role="complementary">
		{{ Widget::group('sidebar') }}
	</aside>
	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">
			@yield('content')
		</main><!-- #main -->
	</div><!-- #primary -->
</div>



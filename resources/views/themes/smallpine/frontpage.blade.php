@extends(Theme::active().'.mainfront')

@section('content')
<div class="row row-content">
	<div class="col-md-12">
		@foreach($blog as $data)
		@include(Theme::active().'.post._view')
		@endforeach	

		{{ $blog->links() }}
	</div>
</div>
@endsection

@push('style-top')
<link rel="stylesheet" href="{{URL::to('/assets/owl.carousel.2/assets/owl.carousel.css')}}">
@endpush
@push('scripts')
<script src="{{URL::to('/assets/owl.carousel.2/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  $('.post-slider').owlCarousel({
		    center: true,
	        loop:true,
	        margin:10,
	        responsiveClass:true,
	        items:5,
	        controlsClass:'sr-slider-post-control',
	        navContainerClass:'sr-slider-post-nav',
	        navClass:["sr-slider-post-prev","sr-slider-post-next"],
	        responsive:{
	            0:{
	                items:1
	            },
	            600:{
	                items:1
	            },
	            1000:{
	                items:2
	            }
	        },     
	        autoplay:true,
	        navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	        autoplayTimeout:3000,
	        nav:true,
	        autoplayHoverPause:true
		});
	});	
</script>
@endpush

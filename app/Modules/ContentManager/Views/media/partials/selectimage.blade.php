<div class="row">
	@foreach($model as $value)
	<div class="col-md-4">
		<div class="image-select">
			@if(isset($name))
				<a href="#" class="btn-add-image-preview" onclick="setimage{{$name}}('{{ url('/uploads').'/'.$value->post_name }}');return false;"><img class="img-responsive" src="{{ url('/uploads').'/'.$value->post_name }}" /> </a>
			@else
				<a href="#" class="btn-add-image-preview" onclick="setimage('{{ url('/uploads').'/'.$value->post_name }}');return false;"><img class="img-responsive" src="{{ url('/uploads').'/'.$value->post_name }}" /> </a>
			@endif
		</div>
	</div>
	@endforeach
	<div class="col-md-12">
		{{ $model->links() }}
	</div>
</div>        


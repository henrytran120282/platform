<div class="panel panel-widget">
  	<div class="panel-heading">
  		<h2 class="panel-title">{{ $options['title'] }}</h2>
  	</div>
  	<div class="panel-body">
  		@foreach ($model as $value)
            <a href="{{ $value->getUrl() }}"><span class="label label-info">{{ $value->name }}</span></a>
	  	@endforeach
	</div>
</div>
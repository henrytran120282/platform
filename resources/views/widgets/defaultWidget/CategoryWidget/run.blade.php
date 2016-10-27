<div class="panel panel-widget">
  	<div class="panel-heading">
  		<h2 class="panel-title">{{ $options['title'] }}</h2>
  	</div>
  	<div class="list-group">
	  	@foreach($model as $value)
	  	<a href="{{ $value->getUrl() }}" class="list-group-item">{{ $value->name }}</a>
	  	@endforeach
	</div>
</div>

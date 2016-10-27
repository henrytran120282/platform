@if($key == 0)
<div class="tab-pane active" id="tab-{{$meta->meta_key}}">
@else
<div class="tab-pane" id="tab-{{$meta->meta_key}}">
@endif
@foreach($meta->getValue() as $value)
	@include('ContentManager::theme.partials.'.$value['type'], ['data' => $value])
@endforeach
</div>
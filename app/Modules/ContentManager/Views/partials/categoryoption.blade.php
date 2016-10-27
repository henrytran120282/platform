<option {{ ($node->term_id == $select) ? "selected" : "" }} value="{{ $node->term_id }}">{{ $node->name }}</option>
@if(count($datas->get()) > 0 )
	@foreach($datas->get() as $node)
	@include('ContentManager::partials.categoryoption', ['datas' => $node->children(),'select'=>$select])
	@endforeach
@endif

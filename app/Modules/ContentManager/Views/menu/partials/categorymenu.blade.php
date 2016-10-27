<li id="term-{{ $node->term_id }}">
	<div class="checkbox">
		<label>
			<input class="catmenu" data-url="{{ $node->slug }}" value="{{ $node->name }}" data-type="category" type="checkbox"> {{ $node->name }}
		</label>
	</div>
</li>
@if(count($datas->get()) > 0 )
	@foreach($datas->get() as $node)
	<li id="child-{{ $node->term_id }}" class="category-child-list">
	    <ul id="parent-{{ $node->parent  }}" class="list-unstyled">
	        {{--@include('ContentManager:menu.partials.categorymenu', ['datas' => $node->children(),'post'=>$post])--}}
			@include('ContentManager::menu.partials.categorymenu', ['datas' => $node->children(),'post'=>false])
	    </ul>
	</li>
	@endforeach
@endif

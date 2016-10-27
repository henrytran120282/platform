<li id="term-{{ $node->term_id }}">
	<div class="checkbox">
		<label>
			@if(!$post)
				<input name="catname[]" value="{{ $node->term_id }}" type="checkbox"> {{ $node->name }}
			@else
				<input name="catname[]" value="{{ $node->term_id }}" {{ ($node->checkRelationPost($post)) ? "checked" : "" }} type="checkbox"> {{ $node->name }}
			@endif
		</label>
	</div>
</li>
@if(count($datas->get()) > 0 )
	@foreach($datas->get() as $node)
	<li id="child-{{ $node->term_id }}" class="category-child-list">
	    <ul id="parent-{{ $node->parent  }}" class="list-unstyled">
	        @include('ContentManager::post.partials.categorylist', ['datas' => $node->children(),'post'=>$post])
	    </ul>
	</li>
	@endforeach
@endif

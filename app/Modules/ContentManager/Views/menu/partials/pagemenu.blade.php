<li id="page-{{ $node->id }}">
	<div class="checkbox">
		<label>
			<input name="catname[]" class="catmenu" data-url="{{ $node->post_name }}" value="{{ $node->post_title }}" type="checkbox"> {{ $node->post_title }}
		</label>
	</div>
</li>
@if(count($datas->get()) > 0 )
	@foreach($datas->get() as $node)
	<li id="child-{{ $node->id }}" class="category-child-list">
	    <ul id="parent-{{ $node->post_parent  }}" class="list-unstyled">
	        @include('ContentManager:menu.partials.pagemenu', ['datas' => $node->children(),'post'=>$post])
	    </ul>
	</li>
	@endforeach
@endif
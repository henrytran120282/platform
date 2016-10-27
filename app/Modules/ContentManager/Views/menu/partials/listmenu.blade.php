<li id="menuItem_{{ $node->id }}">
	<div class="panel panel-primary" data-label="{{ $node->post_title }}" data-url="{{ $node->getMetaValue('_nav_item_url') }}">
	  <div class="panel-heading" >
	  	{{ $node->post_title }}
	  	<a data-target="body-{{ $node->id }}" data-role='toggle-menu' href="#"><i class="fa fa-chevron-down"></i></a>
	  	<a class="deleteMenu" data-id="{{ $node->id }}" href="#"><i class="fa fa-times"></i></a>
	  </div>
	  <div id="body-{{ $node->id }}" class="panel-body" style="display: none;">
	    <div class="form-group">
		    <label for="label-{{ $node->id }}">Label</label>
		    <input data-uset='label' value="{{ $node->post_title }}" data-idpar="menuItem_{{ $node->id }}" type="text" class="form-control" id="label-{{ $node->id }}" placeholder="Label">
	    </div>
	  </div>
	</div>
@if(count($datas) > 0 )
	<ol>
	@foreach($datas as $node)
	   @include('ContentManager::menu.partials.listmenu', ['datas' => $node->children()])
	@endforeach
	</ol>
@endif
</li>
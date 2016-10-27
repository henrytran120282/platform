<li id="menuItem_{{ $widget->id }}">
	<div class="panel panel-primary">
	  <div class="panel-heading" >
	  	{{ $widget->getOptions("title") }}
	  	<a href="#" data-role="saveWidget" data-idwidget="{{ $widget->getOptions('baseID') }}">Save </a>
	  	<a data-target="body-{{ $widget->id }}" data-role='toggle-menu' href="#"><i class="fa fa-chevron-down"></i></a>
	  	<a class="delete-widget" data-url="{{ Admin::route('contentManager.widget.destroy',['id'=>$widget->id]) }}" href="#"><i class="fa fa-times"></i></a>
	  </div>
	  <div id="body-{{ $widget->id }}" class="panel-body" style="display: none;">
	    <div id="{{ $widget->getOptions('baseID') }}" class="form-group">
	    	<input type="hidden" name="id" value="{{ $widget->id }}">
			<input type="hidden" name="baseID" value="{{ $widget->getOptions('baseID') }}">
		    {!! Admin::widget($widget) !!}
	    </div>
	  </div>
	</div>
</li>

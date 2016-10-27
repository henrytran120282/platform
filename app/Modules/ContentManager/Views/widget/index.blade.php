@extends(Admin::theme())

@section('content')
<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h2>Widget Manager</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="default-widget">
						<div class="title"><strong>Default Widget</strong></div>
						<div class="content">
						@foreach($default as $key => $value)
							@include('ContentManager::widget.partials.selectwidget',['group'=>'default'])  
						@endforeach
						</div>
					</div>
					<div class="default-widget">
						<div class="title"><strong>Theme Widget</strong></div>
						<div class="content">
						@foreach($theme as $key => $value)
							@include('ContentManager::widget.partials.selectwidget',['group'=>'theme'])  
						@endforeach
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="default-widget">
						<div class="title"><strong>Widget Position</strong></div>
						<div class="content">
							<div class="row">
							@foreach($widgetGroups as $gr)
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										{{ucwords(str_replace("_"," ",$gr->name))}}
									</div>
									<div class="panel-body">
										<ol id="con-menu" class="sortable" style="padding-left:0;background:#eee">
								    	@foreach($gr->widget() as $widget)
									 		@include('ContentManager::widget.partials.form')  
									 	@endforeach
								    	</ol>
									</div>
								</div>
							</div>
							@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
    </div>
</div>
@endsection

@push('style-top')
<link rel="stylesheet" href="{{ url('/assets/jquery.ui') }}/jquery-ui.css" />
<style type="text/css">
	.placeholder {
		outline: 1px dashed #4183C4;
	}	

	ol.sortable,ol.sortable ol {
		list-style-type: none;
	}

	.sortable li div {
		
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
		cursor: move;
		border-color: #fff;
		margin: 0;
		
	}		
	.sortable .panel-heading{
		position: relative;
	}
	.sortable .panel-heading a{
		position: absolute;
		right: 10px;
		color: #fff;
	}

	.sortable .panel-heading a:first-child{
		right: 52px;
		background-color: #1abb9c;
		color: #fff;
		border-radius: 4px;
		padding-left: 20px;
		padding-right: 20px;
	}
	.sortable .panel-heading a:hover:first-child{
		background-color: #29b197;
	}
	.sortable .panel-heading a:nth-child(2){
		right: 30px;	
	}
</style>
@endpush

@push('scripts')
<script src="{{ url('/assets/jquery.ui') }}/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ url('/assets/js') }}/jquery.mjs.nestedSortable.js"></script>
<script>
$( document ).ready(function() {
	var ns = $('ol.sortable').nestedSortable({
		forcePlaceholderSize: true,
		handle: 'div',
		helper:	'clone',
		items: 'li',
		opacity: .6,
		placeholder: 'placeholder',
		revert: 250,
		tabSize: 25,
		tolerance: 'pointer',
		toleranceElement: '> div',
		isTree: true,
		maxLevels: 1,
		expandOnHover: 700,
		startCollapsed: true,
		stop: function() { 
			var te = $(this).nestedSortable('toArray',{startDepthCount: 0});
			$.ajax({
	              type: 'POST',
	              url: "{{ Admin::route('contentManager.widget.reorder') }}",
	              data: {"_token": "{{ csrf_token() }}","datawidget":te}
	          })
	        .done(function() {
	          
	        });
		}
	});

	$("a[data-role='saveWidget']").on( "click", function() {
        var idwidget = $(this).data('idwidget');
        var tmp = {};
        var dataWidget = $('#'+idwidget+' :input').serializeArray().map(function(x){tmp[x.name] = x.value;});
        $.ajax({
                type: 'POST',
                url: "{{ Admin::route('contentManager.widget.store') }}",
                data: {"_token": "{{ csrf_token() }}","widget":tmp}
            })
          .done(function() {
            
        });
        return false;
    });

    $("a[data-role='toggle-menu']").on( "click", function() {
		 var target = "#"+$(this).data('target');	
	      $(target).toggle();
	      return false;
  	});

  	$("a[data-role='add-widget']").on( "click", function() {
		var className = $(this).data('widgetname');	
		var position = $(this).data('widgetposition');	
	    $.ajax({
                type: 'POST',
                url: "{{ Admin::route('contentManager.widget.addWidget') }}",
                data: {"_token": "{{ csrf_token() }}","className":className,"position":position}
            })
          .done(function() {
            location.reload();
        });
        return false;
  	});

  	$(".delete-widget").on( "click", function() {
		var wurl = $(this).data('url');	
	    $.ajax({
                type: 'DELETE',
                url: wurl,
                data: {"_token": "{{ csrf_token() }}"}
            })
          .done(function() {
            location.reload();
        });
        return false;
  	});
});	
</script>
@endpush
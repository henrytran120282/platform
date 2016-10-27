@extends(Admin::theme())

@section('content')
	<div class="row">
		<div class="x_panel">
          <div class="x_title">
            <h2>Theme Manager</h2>
            <ul class="nav navbar-right panel_toolbox">
            	<li><a href="#">Install Theme</a></li>
              	<li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
             @foreach($models as $value)
				<div class="col-md-3">
					<div class="thumbnail theme-item {{ $value['active'] == 1 ? 'active' : '' }}">
		              <div class="image view view-first">
		                <img style="width: 100%; display: block;" src="{{ url('/themes/'.$value->name) }}/images/{{ $value->image_preview }}" alt="image">
		                <div class="mask">
		                  <p>{{ $value->name }}</p>
		                  <div class="tools tools-bottom">
		                    <a href="{{ Admin::route('contentManager.theme.view',['id'=>$value->id]) }}"><i class="fa fa-eye"></i></a>
		                    <a href="#"><i class="fa fa-times"></i></a>
		                  </div>
		                </div>
		              </div>
		              <div class="caption">
		              	@if($value->status)
							<a href="#" class="btn btn-disabled btn-block btn-sm">Active</a>
		              	@else
							<a href="{{ Admin::route('contentManager.theme.active',['id'=>$value->id]) }}" class="btn btn-success btn-block btn-sm">Active Theme</a>
		              	@endif
		              </div>
		            </div>
				</div>	
			@endforeach
          </div>
        </div>
	</div>

@endsection
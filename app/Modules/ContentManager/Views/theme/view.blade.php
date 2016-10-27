@extends(Admin::theme())

@section('content')
	<div class="row">
		<div class="x_panel">
          <div class="x_title">
            <h2>Theme {{ ucfirst($model->name) }}</h2>
            <ul class="nav navbar-right panel_toolbox">
              	@if($model->status)
              	<li><a href="#" onclick="return false;">Actived</a></li>
              	@else
				<li><a href="#" style="background-color:#449d44;color:#fff;padding-left:20px;padding-right:20px">Active</a></li>
              	@endif
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          	@if (Session::has('success'))
			  <div class="alert alert-success" role="alert">
			    {{ Session::get('success') }}
			  </div>
			@endif
             <div class="row">
				<div class="col-md-4">
					<img style="width: 100%; display: block;" src="{{ url('/themes/'.$model->name) }}/images/{{ $model->image_preview }}" alt="image">
				</div>
				<div class="col-md-8">
					<dl> 
						<dt>Name Theme</dt> 
						<dd>{{$model->name}}</dd> 
						<dt>Author Theme</dt> 
						<dd><a href="{{$model->author_url}}">{{$model->author}}</a></dd>
						<dt>Description</dt> 
						<dd>{{$model->description}}</dd>
					</dl>
				</div>
				<div class="col-md-12">
					<div class="x_panel">
	                  <div class="x_title">
	                    <h2>Theme Options</h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	                      <li><a class="close-link"><i class="fa fa-close"></i></a>
	                      </li>
	                    </ul>
	                    <div class="clearfix"></div>
	                  </div>
	                  <div class="x_content">

	                    <div class="col-xs-3">
	                      <ul class="nav nav-tabs tabs-left">
	                      	@foreach($model->metaOptions() as $key => $meta)
	                      		@if($key == 0)
	                      		<li class="active"><a href="#tab-{{$meta->meta_key}}" data-toggle="tab">{{ ucwords(str_replace("_", " ", $meta->meta_key)) }}</a></li>
	                      		@else
								<li><a href="#tab-{{$meta->meta_key}}" data-toggle="tab">{{ ucwords(str_replace("_", " ", $meta->meta_key)) }}</a></li>
								@endif
							@endforeach
	                      </ul>
	                    </div>
						<form method="POST" action="{{ Admin::route('contentManager.theme.update') }}">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $model->id }}" name="idtheme">	
	                    <div class="col-xs-9">
	                      <!-- Tab panes -->
	                      <div class="tab-content">
	                        @foreach($model->metaOptions() as $key => $meta)
								 @include('ContentManager::theme.partials.generate', ['meta' => $meta])
							@endforeach
	                      </div>
	                      <input type="submit" class="btn btn-success" value="Save">
	                    </div>
						</form>
	                    <div class="clearfix"></div>
	                  </div>
	                </div>
				</div>
             </div>
          </div>
        </div>
	</div>

@endsection
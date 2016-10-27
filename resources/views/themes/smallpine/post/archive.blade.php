@extends(Theme::active().'.main')

@section('content')
<div class="row row-content">
	<div class="col-md-12">
		@foreach($model as $data)
        @include(Theme::active().'.post._view')
        @endforeach

		{{ $model->links() }}
	</div>
</div>
@endsection

@extends(Theme::active().'.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        @foreach($model->posts as $data)
        @include('ContentManager::category.partials._view')
        @endforeach
    </div>
</div>
@endsection

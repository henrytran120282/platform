@extends(Theme::active().'.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        @foreach($model->posts as $data)
        @include(Theme::active().'.post._view')
        @endforeach

        {{ $model->posts->links() }}
    </div>
</div>
@endsection

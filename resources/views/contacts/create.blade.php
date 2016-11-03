@extends(Theme::active().'.main')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Contact</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    @include('adminlte-templates::common.errors')
    	<div class="row">
		    <div class="col-md-12">
                @include('flash::message')
		    </div>
		    {!! Form::open(['route' => 'contacts.store']) !!}

                @include('contacts.fields')

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

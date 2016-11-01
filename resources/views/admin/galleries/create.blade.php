@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Galleries</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    @include('adminlte-templates::common.errors')
    	<div class="row">
		    <div class="col-md-12">
		        @include('adminlte-templates::common.errors')
		    </div>
		    {!! Form::open(['route' => 'admin.galleries.store']) !!}

                @include('admin.galleries.fields')

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

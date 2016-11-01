@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Galleriesr</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    	<div class="row">
		    <div class="col-md-12">
		         @include('adminlte-templates::common.errors')
		    </div>
		    {!! Form::model($galleries, ['route' => ['admin.galleries.update', $galleries->id], 'method' => 'patch']) !!}

                @include('admin.galleries.fields')

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Gallery Imagesr</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    	<div class="row">
		    <div class="col-md-12">
		         @include('adminlte-templates::common.errors')
		    </div>
		    {!! Form::model($galleryImages, ['route' => ['admin.galleryImages.update', $galleryImages->id], 'method' => 'patch', 'class'=>'form', 'novalidate'=>'novalidate', 'files'=>true]) !!}

                @include('admin.gallery_images.fields')

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
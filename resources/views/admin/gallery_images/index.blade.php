@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="x_panel">
    <div class="x_title">
      <h2>Gallery Images</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a href="{!! route('admin.galleryImages.create') !!}" class="btn-toolbox success"><i class="fa fa-plus"></i> Add New</a></li>
      </ul>
      <div class="clearfix"></div>
      @include('flash::message')
    </div>
    <div class="x_content">
      @include('admin.gallery_images.table')
    </div>
  </div>
</div>
@endsection
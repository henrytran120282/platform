@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="x_panel">
    <div class="x_title">
      <h2>Roles</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a href="{!! route('admin.roles.create') !!}" class="btn-toolbox success"><i class="fa fa-plus"></i> Add New</a></li>
      </ul>
      <div class="clearfix"></div>
      @include('flash::message')
    </div>
    <div class="x_content">
      @include('admin.roles.table')
    </div>
  </div>
</div>
@endsection
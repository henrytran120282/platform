@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Create User</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    	<div class="row">
		    <div class="col-md-12">
		        @include('ContentManager::partials.errormessage')
		    </div>
		    @include('ContentManager::user.partials.form')
		</div>
	</div>
</div>
@endsection

@push('scripts')
@include('ContentManager::partials.scriptdelete') 
@endpush
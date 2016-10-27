@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    @include('ContentManager::partials.errormessage')
  </div>
  <div class="col-md-4">
	  @include('ContentManager::tag.partials.form')
  </div>
  <div class="col-md-8">
	  @include('ContentManager::tag.partials.tablemanage',['model'=>$modelAll]) 
  </div>
</div>
@endsection

@push('scripts')
@include('ContentManager::partials.scriptdelete') 
@endpush
@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="x_panel">
    <div class="x_title">
      <h2>Manage Users</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a id="btn-sel-del" style="display:none;" data-url="{{ Admin::route('contentManager.user.index') }}/" href="#" class="btn-toolbox danger"><i class="fa fa-trash"></i> Delete Selected Users</a></li>
        <li><a href="{{ Admin::route('contentManager.user.create') }}" class="btn-toolbox success"><i class="fa fa-plus"></i> Create User</a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      @include('ContentManager::user.partials.table')
    </div>
  </div>
</div>
@endsection

@push('scripts')
@include('ContentManager::partials.scriptdelete') 
@endpush
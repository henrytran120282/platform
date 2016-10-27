@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('ContentManager::partials.errormessage')
    </div>
    @include('ContentManager::user.partials.form')
</div>
@endsection

@push('scripts')
@include('ContentManager::partials.scriptdelete') 
@endpush
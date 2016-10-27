@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('ContentManager::partials.errormessage')
    </div>
    @include('ContentManager::page.partials.form')
</div>

@endsection

@section('style-top')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/tag-autocomplate/bootstrap-tagsinput.css">
@endsection

@push('scripts')
@include('ContentManager::partials.summernote')
@endpush
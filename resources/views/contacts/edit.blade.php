@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="x_panel">
    <div class="x_title">
      <h2>Contactr</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
    	<div class="row">
		    <div class="col-md-12">
		         @include('adminlte-templates::common.errors')
		    </div>
		    {!! Form::model($contact, ['route' => ['admin.contacts.update', $contact->id], 'method' => 'patch']) !!}

                @include('contacts.fields')

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
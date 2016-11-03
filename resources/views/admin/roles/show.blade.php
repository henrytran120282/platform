@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
    </section>
    <div class="content">
        <div class="box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.roles.show_fields')
                    <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
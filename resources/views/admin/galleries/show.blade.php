@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Galleries
        </h1>
    </section>
    <div class="content">
        <div class="box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.galleries.show_fields')
                    <a href="{!! route('admin.galleries.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $galleries->id !!}</p>
</div>

<!-- Gallery Name Field -->
<div class="form-group">
    {!! Form::label('gallery_name', 'Gallery Name:') !!}
    <p>{!! $galleries->gallery_name !!}</p>
</div>

<!-- Gallery Status Field -->
<div class="form-group">
    {!! Form::label('gallery_status', 'Gallery Status:') !!}
    <p>{!! $galleries->gallery_status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $galleries->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $galleries->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $galleries->deleted_at !!}</p>
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $galleryImages->id !!}</p>
</div>

<!-- Image Name Field -->
<div class="form-group">
    {!! Form::label('image_name', 'Image:') !!}
    <p><img width="150" src="/uploads/gallery/{{$galleryImages->gallery_id}}/{{$galleryImages->image_name}}"></p>
</div>

<!-- Image Title Field -->
<div class="form-group">
    {!! Form::label('image_title', 'Image Title:') !!}
    <p>{!! $galleryImages->image_title !!}</p>
</div>

<!-- Image Description Field -->
<div class="form-group">
    {!! Form::label('image_description', 'Image Description:') !!}
    <p>{!! $galleryImages->image_description !!}</p>
</div>

<!-- Gallery Id Field -->
<div class="form-group">
    {!! Form::label('gallery_id', 'Gallery Id:') !!}
    <p>{!! $galleryImages->gallery_id !!}</p>
</div>

<!-- Image Status Field -->
<div class="form-group">
    {!! Form::label('image_status', 'Image Status:') !!}
    <p>{!! $galleryImages->image_status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $galleryImages->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $galleryImages->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $galleryImages->deleted_at !!}</p>
</div>


<!-- Image Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_name', 'Select Image:') !!}
    {!! Form::file('image_name', null, ['class' => 'form-control']) !!}
    @if(isset($galleryImages))
        <img width="200" src="/uploads/gallery/{{$galleryImages->gallery_id}}/{{$galleryImages->image_name}}">
    @endif
</div>

<!-- Image Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_title', 'Image Title:') !!}
    {!! Form::text('image_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image_description', 'Image Description:') !!}
    {!! Form::textarea('image_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image_link', 'Attach Link:') !!}
    {!! Form::text('image_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Gallery Id Field -->
<div class="form-group col-sm-6">
    @if($galleries)
        @foreach($galleries as $gallery)
            <?php $galleryArr[$gallery->id] = $gallery->gallery_name;?>
        @endforeach
    @endif
    {!! Form::label('gallery_id', 'Gallery Id:') !!}
    {!! Form::select('gallery_id', $galleryArr, (isset($galleryImages)?$galleryImages->gallery_id:0), ['class' => 'form-control']) !!}
</div>

<!-- Image Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_status', 'Image Status:') !!}
    {!! Form::select('image_status', [0=>'Deactive', 1=>'Active'], 1, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.galleryImages.index') !!}" class="btn btn-default">Cancel</a>
</div>

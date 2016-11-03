<!-- Gallery Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gallery_name', 'Gallery Name:') !!}
    {!! Form::text('gallery_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Gallery Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gallery_status', 'Gallery Status:') !!}
    {!! Form::select('gallery_status', [0=>'Deactive', 1=>'Active'], (isset($galleries) ? $galleries->gallery_status  : 0), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.galleries.index') !!}" class="btn btn-default">Cancel</a>
</div>

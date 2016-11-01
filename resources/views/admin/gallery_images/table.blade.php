<table class="table table-responsive" id="galleryImages-table">
    <thead>
        <th>Image Name</th>
        <th>Image Title</th>
        <th>Image Description</th>
        <th>Gallery Id</th>
        <th>Image Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($galleryImages as $galleryImages)
        <tr>
            <td>{!! $galleryImages->image_name !!}</td>
            <td>{!! $galleryImages->image_title !!}</td>
            <td>{!! $galleryImages->image_description !!}</td>
            <td>{!! $galleryImages->gallery_id !!}</td>
            <td>{!! $galleryImages->image_status !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.galleryImages.destroy', $galleryImages->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.galleryImages.show', [$galleryImages->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.galleryImages.edit', [$galleryImages->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
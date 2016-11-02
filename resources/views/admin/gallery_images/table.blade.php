<table class="table table-responsive" id="galleryImages-table">
    <thead>
        <th>Image</th>
        <th>Image Title</th>
        <th>Image Description</th>
        <th>Gallery Id</th>
        <th>Image Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($galleryImages as $galleryImages)
        <tr>
            <td><img width="150" src="/uploads/gallery/{{$galleryImages->gallery_id}}/{{$galleryImages->image_name}}"></td>
            <td>{!! $galleryImages->image_title !!}</td>
            <td>{!! $galleryImages->image_description !!}</td>
            <td>{!! $galleryImages->gallery->gallery_name !!}</td>
            <td>{!! (($galleryImages->image_status == true)? '<span class="label label-success">Active</span>':'<span class="label label-danger">Deactive</span>') !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.galleryImages.destroy', $galleryImages->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.galleryImages.edit', [$galleryImages->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="galleries-table">
    <thead>
        <th>Gallery Name</th>
        <th>Gallery Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($galleries as $galleries)
        <tr>
            <td>{!! $galleries->gallery_name !!}</td>
            <td>{!! (($galleries->gallery_status == true)? '<span class="label label-success">Active</span>':'<span class="label label-danger">Deactive</span>') !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.galleries.destroy', $galleries->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.galleries.edit', [$galleries->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="roles-table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Deleted At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($roles as $roles)
        <tr>
            <td>{!! $roles->name !!}</td>
            <td>{!! $roles->description !!}</td>
            <td>{!! $roles->status !!}</td>
            <td>{!! $roles->created_at !!}</td>
            <td>{!! $roles->updated_at !!}</td>
            <td>{!! $roles->deleted_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.roles.destroy', $roles->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.roles.show', [$roles->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.roles.edit', [$roles->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
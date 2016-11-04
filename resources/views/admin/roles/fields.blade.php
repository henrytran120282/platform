<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', [0=>'Deactive',1=>'Active'], 1, ['class' => 'form-control']) !!}
</div>
<!-- Permission List -->
<div class="form-group col-sm-12">
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Open to select permission</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <?php $permissionList = App\Facades\Helper::permissionList('administrator'); echo $permissionList;?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">Cancel</a>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $("#fullaccess").attr('checked', false);
        $("#fullaccess").change(function () {
            if (this.checked) {
                $('li >input[type="checkbox"]').attr('checked', true);
            } else {
                $('li >input[type="checkbox"]').attr('checked', false);
            }
        })
    });
</script>
@endpush

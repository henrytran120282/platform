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
<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', [''=>'Please select type','admin'=>'Administrators','users'=>'Users'], ($roles->type), ['class' => 'form-control','id'=>'type']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', [0=>'Deactive',1=>'Active'], 1, ['class' => 'form-control']) !!}
</div>
<!-- Permission List -->
<?php
$permissionAsigned = isset($roles->permission) ? $roles->permission : null;
?>
<div class="form-group col-md-12 hidden" id="permissionList">
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Open to select permission</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div id="administrators" class="hidden">
                        <?php
                        $permissionList = Helper::permissionList('administrator', $permissionAsigned);
                        print $permissionList;
                        ?>
                    </div>
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
        //Process permission list
        $("#administrator-role").change(function () {
            if (this.checked == true) {
                $('#checkBoxChild-administrator, #checkBoxParent-administrator').attr('checked', true);
            } else {
                $('#checkBoxChild-administrator, #checkBoxParent-administrator').removeAttr('checked');
            }
        });
        //Default loading role
        if ($('#type').val() != null) {
            var SelectedValue = $('#type  option:selected').val();
            loadPermissionList(SelectedValue);
        }
        //Process update role-permission
        $('#type').change(function () {
            var SelectedValue = $('#type  option:selected').val();
            loadPermissionList(SelectedValue);
        });
        //Expand or Collapse panel
        $('.btn-info').click(function () {
            var currentID = $(this).attr('data-target');
            $('.btn-info').each(function (index, obj) {
                var ID = $(this).attr('data-target');
                if (currentID != ID) {
                    $('div' + ID).removeClass('in');
                    $('div' + ID).removeAttr('aria-expanded');
                    $(this).removeAttr('aria-expanded');
                }
            });
        });
    });
    //Function show permission list
    function loadPermissionList(SelectedValue) {
        //Check selected User-Role
        switch (SelectedValue) {
            case 'users':
            case 'admin':
                $('#permissionList').removeClass('hidden');
                $('#administrators').removeClass('hidden');
                break;
            default :
                //Process init user-role
                $('#permissionList').addClass('hidden');
                $('#administrators').addClass('hidden');
                break;
        }
    }
</script>
@endpush

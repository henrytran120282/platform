<form method="POST"
      action="{{ ($model != "") ? Admin::route('contentManager.user.update',['user'=>$model->id]) : Admin::route('contentManager.user.store') }}">
    <div class="col-md-4">
        @include('ContentManager::partials.imageUpload',['dataID'=>'userPhoto','dataValue'=>($model != "" ) ? $model->photo : old('photo'),'dataName'=>'photo'])
        <div class="clearfix"></div>
        <!-- Permission List -->
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
                                <?php $permissionList = App\Facades\Helper::permissionList('administrator'); print $permissionList;?>
                            </div>
                            <div id="users" class="hidden">
                                <?php $permissionList = App\Facades\Helper::permissionList('users'); print $permissionList;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        {{ csrf_field() }}
        @if($model != "")
            <input name="_method" type="hidden" value="PUT">
        @endif
        <div class="form-group">
            <label for="name-user">Name *</label>
            <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->name : old('name') }}"
                   name="name" id="name-tag" placeholder="Name User">
        </div>
        <div class="form-group">
            <label for="email-user">Email *</label>
            <input type="text" class="form-control" value="{{ ($model != "" ) ? $model->email : old('email') }}"
                   name="email" id="email-user" placeholder="Email User">
        </div>
        <div class="form-group">
            <label for="desctiption-user">Roles</label>
            <select id="role_id" name="role_id" class="form-control">
                <option value="">Please Select Role</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{((!empty($model) && ($role->id == $model->role_id))? 'selected': null)}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="desctiption-user">Description</label>
            <textarea class="form-control" name="description"
                      rows="3">{{ ($model != "" ) ? $model->description : old('description') }}</textarea>
        </div>
        @if($model == "")
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>
        @endif
        @if($model == "")
            <button type="submit" class="btn btn-default">Create</button>
        @else
            <button type="submit" class="btn btn-default">Save</button>
        @endif
    </div>
</form>
@push('scripts')
<script>
    $(document).ready(function () {
        //Process permission list
        $("#fullaccess").change(function () {
            if (this.checked == true) {
                $('#checkBoxChild, #checkBoxParent').attr('checked', true);
            } else {
                $('#checkBoxChild, #checkBoxParent').removeAttr('checked');
            }
        });
        //Process update role-permission
        $('#role_id').change(function(){
            var SelectedValue = $('#role_id  option:selected').text();
            //Check selected User-Role
            switch(SelectedValue){
                case 'Administrator':
                    $('#users').addClass('hidden');
                    $('#permissionList').removeClass('hidden');
                    $('#administrators').removeClass('hidden');
                    break;
                case 'Users':
                    $('#administrators').addClass('hidden');
                    $('#permissionList').removeClass('hidden');
                    $('#users').removeClass('hidden');
                    break;
                default :
                    //Process init user-role
                    $('#permissionList').addClass('hidden');
                    $('#administrators').addClass('hidden');
                    $('#users').addClass('hidden');
                    break;
            }
        });
    });
</script>
@endpush
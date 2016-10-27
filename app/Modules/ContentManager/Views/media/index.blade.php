@extends('layouts.admin')

@section('content')
<div class="row">
		<div class="x_panel">
          <div class="x_title">
            <h2>Media Manager</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a id="btn-sel-del" style="display:none;" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Selected media</a></li>
                <li><a href="#" id="btn-upload-files"><i class="fa fa-cloud-upload"></i> Upload Files</a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="drop-upload" style="display:none">
        			<div id="file-upload" class="mydropzone dropzone">
                <div class="dz-default dz-message">
                  <div>
                  <i class="fa fa-cloud-upload fa-5x"></i>
                  </div>
                  <span>Drop files here to upload</span>
                </div>
              </div>
            </div>
      			<div  style="position:relative">
              <table class="table table-striped jambo_table bulk_action"> 
                  <thead>
                    <tr> 
                      <th>
                        <div class="checkbox-style">
                          <input id="checkAll" type="checkbox">
                          <label for="checkAll">&nbsp;</label>
                        </div>
                      </th>
                      <th>Image / Icon</th> 
                      <th>Detail</th> 
                    </tr> 
                  </thead>
                  <tbody id="table-media">
                   @include('ContentManager::media.partials.table')
                  </tbody>  
              </table>

              <div class="spinner" style="display:none">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
              </div> 
      			</div>
		  </div>
    </div>
</div>
@endsection

@push('style-top')
<link href="{{URL::to('/')}}/assets/dropzone/dropzone.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ Url('/') }}/assets/dropzone/dropzone.min.js"></script>
<script>
    var myDropzone = new Dropzone("div#file-upload", { 
      url: "{{ Admin::route('contentManager.media.store') }}"
    });
    myDropzone.on("sending", function(file, xhr, formData) {
          formData.append("_token", "{{ csrf_token() }}");
    });
    myDropzone.on("queuecomplete", function(file, xhr, formData) {
           getPosts("1");
           myDropzone.removeAllFiles(true);
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
        $("#btn-upload-files").on('click',function(e){
            e.preventDefault();
            $("#drop-upload").toggle();    
        });
    });
    function getPosts(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
            beforeSend:function(){
                $(".spinner").show();    
            }
        }).done(function (data) {
            $(".spinner").hide();
            $('#table-media').html(data);
            $('#checkAll').prop('checked', false);
        }).fail(function () {
            $(".spinner").hide();
            alert('Posts could not be loaded.');

        });
    }
</script>
<script>
$( document ).ready(function() {
    $("a[data-role='delete-post']").on( "click", function() {
        var idpost = $(this).data('idpost');
        swal({
          title: "Are you sure?",
          text: "Delete this media",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonText: "Yes",
          confirmButtonClass: "btn-danger",
          cancelButtonText: "No"
        }, function () {
          $.ajax({
                type: 'DELETE',
                url: "{{ Admin::route('contentManager.media.destroy') }}/"+idpost,
                data: {"_token": "{{ csrf_token() }}"}
            })
          .done(function() {
            swal("Deleted!", "Delete Success", "success");
            $("#tr-"+idpost).remove();
          });
        });
        return false;
    });

    $("#checkAll").change(function () {
        $("input:checkbox[name=checkbox]").prop('checked', $(this).prop("checked"));
        if($("#btn-sel-del").css('display') == 'none'){
            $("#btn-sel-del").css("display","inline-block");
        }else{
            $("#btn-sel-del").css("display","none");
        }
    });

    $( "input[type=checkbox]" ).on( "change", function () {
        var n = $( "input:checked[name=checkbox]" ).length;
        if(n == 0){
            $("#btn-sel-del").css("display","none");
        }else{
            $("#btn-sel-del").css("display","inline-block");
        }
    });

    $("#btn-sel-del").on("click",function(){
        var array = new Array();
        $("input:checkbox[name=checkbox]:checked").each(function(){
            array.push($(this).val());
        });
        var id = array.join()
        swal({
          title: "Are you sure?",
          text: "Delete the selected Media",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonText: "Yes",
          confirmButtonClass: "btn-danger",
          cancelButtonText: "No"
        }, function () {
          $.ajax({
                type: 'DELETE',
                url: "{{ Admin::route('contentManager.media.destroy') }}/"+id,
                data: {"_token": "{{ csrf_token() }}"}
            })
          .done(function() {
            swal("Deleted!", "Delete Success", "success");
            location.reload();
          });
        });
        return false;
    });
});
</script>
@endpush
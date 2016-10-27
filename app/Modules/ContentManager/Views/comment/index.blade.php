@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="x_panel">
    <div class="x_title">
      <h2>Media Comment</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a id="btn-sel-del" style="display:none;" href="#" class="btn-toolbox danger"><i class="fa fa-trash"></i> Delete Selected Comment</a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      @include('ContentManager::comment.partials.table')
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ Url('/') }}/assets/dropzone/dropzone.min.js"></script>
<script>
$( document ).ready(function() {
    $("a[data-role='delete-post']").on( "click", function() {
        var idpost = $(this).data('idpost');
        swal({
          title: "Are you sure?",
          text: "Delete this comment",
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
                url: "{{ Admin::route('contentManager.comment.destroy') }}/"+idpost,
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
          text: "Delete the selected comments",
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
                url: "{{ Admin::route('contentManager.comment.destroy') }}/"+id,
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
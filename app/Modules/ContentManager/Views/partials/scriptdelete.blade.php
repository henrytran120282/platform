<script type="text/javascript">
$( document ).ready(function() {
	$("a[data-role='delete-post']").on( "click", function() {
      var idpost = $(this).data('idpost');
      var urlDelete = $(this).data('url');
      swal({
        title: "Are you sure?",
        text: "Delete this post",
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
              url: urlDelete+idpost,
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
            console.log($(this).attr('id'));
        });
        var urlDelete = $(this).data('url');
        var id = array.join()
        swal({
          title: "Are you sure?",
          text: "Delete the selected post",
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
                url: urlDelete+id,
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

function showDeleteBtn(){
  var n = $( "input:checked[name=checkbox]" ).length;
  if(n == 0){
      $("#btn-sel-del").css("display","none");
  }else{
      $("#btn-sel-del").css("display","inline-block");
  }
}

</script>
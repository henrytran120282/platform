@push('style-top')
<link href="{{ Url('/assets/switchery') }}/switchery.min.css" rel="stylesheet">
<link href="{{ Url('/assets/summernote') }}/summernote.css" rel="stylesheet">
<link href="{{ Url('/assets/jquery.ui') }}/jquery-ui.css" rel="stylesheet">

@endpush
<script src="{{ Url('/assets/jquery.ui') }}/jquery-ui.min.js"></script>
<script src="{{ Url('/assets/jquery.tagsinput') }}/jquery.tagsinput.js"></script>
<script src="{{ Url('/assets/switchery') }}/switchery.min.js"></script>
<script src="{{ Url('/assets/summernote') }}/summernote.js"></script>
<script>
$( document ).ready(function() {
  $('#content-post').summernote({
    height: 300,               
    minHeight: null,             
    maxHeight: null,             
    focus: true,                  
    toolbar: [
      ['style', ['bold', 'italic', 'underline']],
      ['para', ['ul', 'ol', 'paragraph','style']],
      ['misc', ['link','fullscreen','codeview','SImage','video']]
    ],
    buttons: {
      SImage: imageMedia
    }
  });

  $("#input-category").hide();
  $("#btn-add-category").on("click",function(){
      $("#input-category").toggle();
      return false;
  });

   $('#tags').tagsInput({
      width: 'auto'
      //autocomplete_url: '{{ Admin::route("contentManager.post.tags") }}'
    });

  $("#add-category").on("click",function(){
    var namecat = $("#name-category").val();
    var parentcat = $("#parent-category").val();
    if(namecat.trim() == ""){
      swal("Not", "Name cateogry is required", "warning");
    }else{
      $.ajax({
            type: 'POST',
            url: "{{ Admin::route('contentManager.category.store') }}",
            data: {
              "_token": "{{ csrf_token() }}",
              "name": namecat,
              "parent":parentcat,
              "description":""
            },
            dataType: "json"
        })
      .done(function(data) {
        if(parentcat == 0){
          $("#parent-"+parentcat).append('<li id="term-'+data.id+'"><div class="checkbox"><label><input value="'+data.id+'" name="catname[]" type="checkbox" /> '+namecat+' </label></div></li>');
        }else{
          if($('#parent-'+parentcat).length > 0){
            $("#parent-"+parentcat).append('<li id="term-'+data.id+'"><div class="checkbox"><label><input value="'+data.id+'" name="catname[]" type="checkbox" /> '+namecat+' </label></div></li>');
          }else{
            $("#term-"+parentcat).append('<ul id="parent-'+data.parent+'" class="list-unstyled"><li id="term-'+data.id+'"><div class="checkbox"><label><input value="'+data.id+'" name="catname[]" type="checkbox" /> '+namecat+' </label></div></li></ul>');
            $("#term-"+data.id).addClass("category-child-list");
          }
        }
        $("#parent-category").append('<option value="'+data.id+'">'+namecat+'</option>');
        $("#name-category").val("");
      });
    }
    
    return false;
  });

});
var summer = false;
var imageMedia = function (context) {
      var ui = $.summernote.ui;
    
      var button = ui.button({
        contents: '<i class="fa fa-image"/>',
        tooltip: 'Image Media',
        click: function () {
          summer = true;
          defaultActive();
          $('#featuredImage').modal('show')
        }
      });

      return button.render();   // return button as jquery object 
    }
</script>  
@push('style-top')
<link href="{{ Url('/assets/summernote') }}/summernote.css" rel="stylesheet">
@endpush
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
      ['misc', ['fullscreen','codeview','SImage','video']]
    ],
    buttons: {
      SImage: imageMedia
    }
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
        $('#featuredImage').modal('show');
        $('#tab-file').show();
      }
  });
  return button.render(); 
}
</script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
tinymce.PluginManager.add('example', function(editor, url) {
  // Add a button that opens a window
  editor.addButton('example', {
    text: 'My button',
    icon: false,
    onclick: function() {
      // Open window with a specific url
      editor.windowManager.open({
        title: 'TinyMCE site',
        url: '{{Url("/contentManager/imageTiny")}}',
        width: 700,
        height: 400,
        buttons: [{
          text: 'Close',
          onclick: 'close'
        }]
      });
    }
  });
});
</script>
<script>tinymce.init({ 
    selector:'textarea',
    plugins: 'example'
  });
</script>
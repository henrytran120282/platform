<button id="btn-{{$idModal}}" type="button" class="btn btn-success btn-sm btn-block">
  <i class="fa fa-upload"></i> Select Image
</button>
<img id="btn-upload-image-preview" class="img-responsive" src="{{ ($model != "" ) ? $model->getMetaValue('featured_img') : old('meta[featured_img]') }}" />
<input type="hidden" id="meta_featured_img" class="form-control" name="meta[featured_img]" value="{{ ($model != "" ) ? $model->getMetaValue('featured_img') : old('meta[featured_img]') }}" placeholder="Meta Featured Image">
<div class="modal fade" id="{{$idModal}}" tabindex="-1" role="dialog" aria-labelledby="{{$idModal}}Label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload your file or select media</h4>
      </div>
      <div class="modal-body">
          <ul class="nav nav-tabs" role="tablist">
            <li id="tab-home" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Upload Image</a></li>
            <li id="tab-image" role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">Images</a></li>
            <li id="tab-file" role="presentation"><a href="#file" aria-controls="file" role="tab" data-toggle="tab">Files</a></li>
          </ul>
          <div id="media-content" class="tab-content">
            <div role="tabpanel" class="tab-pane" id="home">
                <div id="file-upload" class="mydropzone dropzone">
                  <div class="dz-default dz-message">
                    <div>
                    <i class="fa fa-cloud-upload fa-5x"></i>
                    </div>
                    <span>Drop files here to upload</span>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="image">
              @include('ContentManager::media.partials.selectimage',['model'=>Admin::media()])
            </div>
            <div role="tabpanel" class="tab-pane" id="file">
               fsdfsdfsdfsdfsd
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
          getPosts('{{ Admin::route("contentManager.media.images") }}');
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href'));
            e.preventDefault();
        });
        $("#btn-{{$idModal}}").on('click',function(){
          defaultActive();
          $("#{{$idModal}}").modal("show");
          summer = false;
          $('#tab-file').hide();
          
        });
    });

    function defaultActive(act = "home"){
      $('#tab-home').removeClass("active");
      $('#home').removeClass("active");
      $('#tab-file').removeClass("active");
      $('#file').removeClass("active");
      $('#tab-image').removeClass("active");
      $('#image').removeClass("active");

      $('#tab-'+act).addClass("active");
      $('#'+act).addClass("active");
    }

    function setimage(img){
      if(summer){
        $('#content-post').summernote('insertImage', img);
      }else{
        $("#btn-upload-image-preview").attr("src",img);  
      }
      $("#{{$idModal}}").modal("hide");
      $('#{{$setInput}}').val(img);
    }

    function getPosts(page) {
        $.ajax({
            url : page,
            dataType: 'json',
        }).done(function (data) {
            $('#image').html(data);
            defaultActive("image");
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
</script>
@endpush
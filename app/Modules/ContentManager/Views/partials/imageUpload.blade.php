{{-- 
  @include('ContentManager::partials.imageUpload',[
    'dataID'=>'$yourID',
    'dataValue'=>'$yourValue',
    'dataName'=>'$yourNameInput'
  ])  
 --}}
<button id="btn-{{ $dataID }}" type="button" class="btn btn-success btn-sm btn-block">
  <i class="fa fa-upload"></i> Select Image
</button>
<img id="img-{{ $dataID }}" class="img-responsive" src="{{ $dataValue }}" />
<input type="hidden" id="input-{{ $dataID }}" class="form-control" value="{{ $dataValue }}" name="{{ $dataName }}">
<div class="modal fade" id="{{ $dataID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $dataID }}Label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload your file or select media</h4>
      </div>
      <div class="modal-body">
          <ul class="nav nav-tabs" role="tablist">
            <li id="{{ $dataID }}tab-home" role="presentation" class="active"><a href="#{{ $dataID }}home" aria-controls="{{ $dataID }}home" role="tab" data-toggle="tab">Upload Image</a></li>
            <li id="{{ $dataID }}tab-image" role="presentation"><a href="#{{ $dataID }}image" aria-controls="{{ $dataID }}image" role="tab" data-toggle="tab">Images</a></li>
          </ul>
          <div id="media-content" class="tab-content">
            <div role="tabpanel" class="tab-pane" id="{{ $dataID }}home">
                <div id="file-upload{{ $dataID }}" class="mydropzone dropzone">
                  <div class="dz-default dz-message">
                    <div>
                    <i class="fa fa-cloud-upload fa-5x"></i>
                    </div>
                    <span>Drop files here to upload</span>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="{{ $dataID }}image">
              @include('ContentManager::media.partials.selectimage',['model'=>Admin::media(),'name'=>$dataID])
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@pushonce('style')
<link href="{{URL::to('/')}}/assets/dropzone/dropzone.min.css" rel="stylesheet">
@endpushonce
@pushonce('scripts')
<script src="{{ Url('/') }}/assets/dropzone/dropzone.min.js"></script>
@endpushonce
@push('scripts')
<script>
  var myDropzone = new Dropzone("div#file-upload{{ $dataID }}", { 
      url: "{{ Admin::route('contentManager.media.store') }}"
    });
    myDropzone.on("sending", function(file, xhr, formData) {
          formData.append("_token", "{{ csrf_token() }}");
    });
    myDropzone.on("queuecomplete", function(file, xhr, formData) {
          getPosts{{ $dataID }}('{{ Admin::route("contentManager.media.images") }}');
    });
    function defaultActive{{ $dataID }}(act = "home"){
      $('#{{ $dataID }}tab-home').removeClass("active");
      $('#{{ $dataID }}home').removeClass("active");
      $('#{{ $dataID }}tab-image').removeClass("active");
      $('#{{ $dataID }}image').removeClass("active");

      $('#{{ $dataID }}tab-'+act).addClass("active");
      $('#{{ $dataID }}'+act).addClass("active");
    }
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts{{ $dataID }}($(this).attr('href'));
            e.preventDefault();
        });
        $("#btn-{{ $dataID }}").on('click',function(){
          defaultActive{{ $dataID }}();
          $("#{{ $dataID }}").modal("show");
        });
    });

    function setimage{{$dataID}}(img){
      $("#img-{{ $dataID }}").attr("src",img);
      $("#{{ $dataID }}").modal("hide");
      $("#input-{{ $dataID }}").val(img);
    }

    function getPosts{{ $dataID }}(page) {
        $.ajax({
            url : page,
            dataType: 'json',
            data:{name:"{{ $dataID }}"}
        }).done(function (data) {
            $('#{{ $dataID }}image').html(data);
            defaultActive{{ $dataID }}("image");
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
</script>
@endpush
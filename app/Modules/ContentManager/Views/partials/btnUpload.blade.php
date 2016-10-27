<button id="btn-{{ $data['name'] }}" type="button" class="btn btn-success btn-sm btn-block">
  <i class="fa fa-upload"></i> Select Image
</button>
<img id="img-{{ $data['name'] }}" class="img-responsive" src="{{ $data['value'] }}" />
<input type="hidden" id="input-{{ $data['name'] }}" class="form-control" value="{{ $data['value'] }}" name="meta[{{ $meta->meta_key }}][{{ $data['name'] }}][value]">
<div class="modal fade" id="{{$data['name']}}" tabindex="-1" role="dialog" aria-labelledby="{{$data['name']}}Label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload your file or select media</h4>
      </div>
      <div class="modal-body">
          <ul class="nav nav-tabs" role="tablist">
            <li id="{{ $data['name'] }}tab-home" role="presentation" class="active"><a href="#{{ $data['name'] }}home" aria-controls="{{ $data['name'] }}home" role="tab" data-toggle="tab">Upload Image</a></li>
            <li id="{{ $data['name'] }}tab-image" role="presentation"><a href="#{{ $data['name'] }}image" aria-controls="{{ $data['name'] }}image" role="tab" data-toggle="tab">Images</a></li>
          </ul>
          <div id="media-content" class="tab-content">
            <div role="tabpanel" class="tab-pane" id="{{ $data['name'] }}home">
                <div id="file-upload{{ $data['name'] }}" class="mydropzone dropzone">
                  <div class="dz-default dz-message">
                    <div>
                    <i class="fa fa-cloud-upload fa-5x"></i>
                    </div>
                    <span>Drop files here to upload</span>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="{{ $data['name'] }}image">
              @include('ContentManager::media.partials.selectimage',['model'=>Admin::media(),'name'=>$data['name']])
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
  var myDropzone = new Dropzone("div#file-upload{{ $data['name'] }}", { 
      url: "{{ Admin::route('contentManager.media.store') }}"
    });
    myDropzone.on("sending", function(file, xhr, formData) {
          formData.append("_token", "{{ csrf_token() }}");
    });
    myDropzone.on("queuecomplete", function(file, xhr, formData) {
          getPosts{{ $data["name"] }}('{{ Admin::route("contentManager.media.images") }}');
    });
    function defaultActive{{ $data["name"] }}(act = "home"){
      $('#{{ $data["name"] }}tab-home').removeClass("active");
      $('#{{ $data["name"] }}home').removeClass("active");
      $('#{{ $data["name"] }}tab-image').removeClass("active");
      $('#{{ $data["name"] }}image').removeClass("active");

      $('#{{ $data["name"] }}tab-'+act).addClass("active");
      $('#{{ $data["name"] }}'+act).addClass("active");
    }
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts{{ $data['name'] }}($(this).attr('href'));
            e.preventDefault();
        });
        $("#btn-{{$data['name']}}").on('click',function(){
          defaultActive{{ $data['name'] }}();
          $("#{{$data['name']}}").modal("show");
        });
    });

    function setimage{{$data['name']}}(img){
      $("#img-{{ $data['name'] }}").attr("src",img);
      $("#{{$data['name']}}").modal("hide");
      $("#input-{{ $data['name'] }}").val(img);
    }

    function getPosts{{$data['name']}}(page) {
        $.ajax({
            url : page,
            dataType: 'json',
            data:{name:"{{ $data['name'] }}"}
        }).done(function (data) {
            $('#{{ $data["name"] }}image').html(data);
            defaultActive{{ $data["name"] }}("image");
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
</script>
@endpush
@foreach ($model as $data)
<tr id="tr-{{ $data->id }}"> 
    <td style="width:50px">
      <div class="checkbox-style">
        <input id="id-{{$data->id}}" type="checkbox" name="checkbox" data-role="checkbox" onchange="showDeleteBtn();" value="{{$data->id}}" /> 
        <label for="id-{{$data->id}}">&nbsp;</label>
      </div>
      <input type="hidden" id="idPost" value="{{ $data->id }}">
    </td>
    <td style="width:200px">{!! Admin::iconMedia($data) !!}</td> 
    <td>
        <dl>
          <dt>File Name</dt>
          <dd>{{ $data->post_title }}</dd>
          <dt>File Mime Type</dt>
          <dd>{{ $data->post_mime_type }}</dd>
          <dt>File Size</dt>
          <dd>{!! Admin::formatBytes($data->getMetaValue('_file_size')) !!}</dd>
        </dl>
    </td> 
</tr> 
@endforeach
<tr class="tbl-bottom">
  <td colspan="3">
    {{ $model->links() }}
  </td>
</tr>  



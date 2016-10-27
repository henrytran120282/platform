<div class="form-group">
	<label for="id-{{ $data['name'] }}">{{ $data['label'] }} :</label>
	<select id="id-{{ $data['name'] }}" class="form-control" name="meta[{{ $meta->meta_key }}][{{ $data['name'] }}][value]">
	  @foreach($data['options'] as $key => $value)
	  <option {{ $key == $data['value'] ? "selected" : ""}} value="{{$key}}">{{$value}}</option>
	  @endforeach
	</select>
</div>
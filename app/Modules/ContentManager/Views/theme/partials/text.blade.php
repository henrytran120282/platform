<div class="form-group">
	<label for="id-{{ $data['name'] }}">{{ $data['label'] }} :</label>
	<input type="text" id="id-{{ $data['name'] }}" class="form-control" value="{{ $data['value'] }}" name="meta[{{ $meta->meta_key }}][{{ $data['name'] }}][value]">
</div>
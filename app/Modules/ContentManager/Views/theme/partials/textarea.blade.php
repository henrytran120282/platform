<div class="form-group">
	<label for="id-{{ $data['name'] }}">{{ $data['label'] }} :</label>
	<textarea id="id-{{ $data['name'] }}" class="form-control" name="meta[{{ $meta->meta_key }}][{{ $data['name'] }}][value]">{{ $data['value'] }}</textarea>
</div>
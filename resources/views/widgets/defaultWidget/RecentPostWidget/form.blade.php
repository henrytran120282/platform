<div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input id="title" value="{{ $options['title'] }}" class="form-control" type="text" name="title">
</div>
<div class="form-group">
    <label for="description" class="control-label">Description</label>
    <textarea id="description" name='description' class="form-control" rows="3">{{ (isset($options['description'])?$options['description']:null) }}</textarea>
</div>
<div class="form-group">
    <label for="show" class="control-label">Limit</label>
    <select name="show" class="form-control">
        @for($i = 1; $i < 11 ; $i++)
            <option {{ $options['show'] == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} Post</option>
        @endfor
    </select>
</div>
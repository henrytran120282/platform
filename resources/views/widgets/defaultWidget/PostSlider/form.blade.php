<div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input id="title" value="{{ $options['title'] }}" class="form-control" type="text" name="title">
</div>
<div class="form-group">
    <label for="type" class="control-label">Type</label>
    <select name="type" class="form-control">
        <option {{ $options['type'] == 'featured-post' ? 'selected' : '' }} value="featured-post">Featured Post</option>
        <option {{ $options['type'] == 'recent-post' ? 'selected' : '' }} value="recent-post">Recent Post</option>
        @foreach ($model as $value)
        <option {{ $options['type'] == $value->term_id ? 'selected' : '' }} value="{{ $value->term_id }}">{{ $value->name }}</option>                              
        @endforeach
    </select>
</div>
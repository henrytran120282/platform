<div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input id="title" value="{{ $options['title'] }}" class="form-control" type="text" name="title">
    <label for="type" class="control-label">Select categories</label>
    <select name="type" id="type" class="form-control">
        <option value="0">All</option>
        @foreach($options['categoryList'] as $key=>$value)
            <option value="{{$key}}" {{(($options['type'] == $value)? 'selected' :null)}}>{{$value}}</option>
        @endforeach
    </select>
</div>
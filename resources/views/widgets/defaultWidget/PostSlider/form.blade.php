<div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input id="title" value="{{ $options['title'] }}" class="form-control" type="text" name="title">
</div>
<div class="form-group">
    <label for="type" class="control-label">Type</label>
    <select id="type" name="type" class="form-control">
        <optgroup label="Posts & Gallery">
            <option {{ $options['type'] == 'featured-post' ? 'selected' : '' }} value="featured-post">Featured Post</option>
            <option {{ $options['type'] == 'recent-post' ? 'selected' : '' }} value="recent-post">Recent Post</option>
            <option {{ $options['type'] == 'gallery' ? 'selected' : '' }} value="gallery">Gallery</option>
        </optgroup>
        <optgroup label="Category">
            @foreach ($model as $value)
            <option {{ $options['type'] == $value->term_id ? 'selected' : '' }} value="{{ $value->term_id }}">{{ $value->name }}</option>
            @endforeach
        </optgroup>
    </select>
    <div id="galleries" class="hidden">
        <label for="gallery" class="control-label">Select Gallery</label>
        <select name="gallery_id" class="form-control">
            @foreach ($galleries as $value)
                <option {{ $options['type'] == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->gallery_name }}</option>
            @endforeach
        </select>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#type').change(function(){
            if($(this).val() == 'gallery'){
                $('#galleries').removeClass('hidden');
            }else{
                $('#galleries').addClass('hidden');
            }
        });
    });
</script>
@endpush

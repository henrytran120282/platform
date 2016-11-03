<div class="post-slider">
    {{--Validate Slider Type--}}
    @if($options['type'] === 'gallery')
        {{--Begin /Gallery Slider--}}
        @foreach ($model as $value)
            <div class="slider-cont">
                <div class="slider-img">
                    <img src="/uploads/gallery/{{$options['gallery_id']}}/{{$value->image_name}}"
                         class="img-responsive"/>
                </div>
                <div class="slider-content">
                    <a href="{{$value->image_link}}">
                        <h1>{{ $value->image_title }}</h1>
                    </a>

                    <div class="slider-meta">
                        <p>{{$value->image_description}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{--End /Gallery Slider--}}
    @else
        {{--Begin /Post or Category Slider--}}
        @foreach ($model as $value)
            <div class="slider-cont">
                <div class="slider-img">
                    <img src="{{ $value->getMetaValue('featured_img') }}" class="img-responsive"/>
                </div>
                <div class="slider-content">
                    <a href="{{ $value->getUrl() }}">
                        <h1>{{ $value->post_title }}</h1>
                    </a>

                    <div class="slider-meta">
                        <span><i class="fa fa-clock-o"></i> {{ $value->updated_at->format('M d, Y') }}</span>
                        <span><i class="fa fa-user"></i> {{ $value->user->name }}</span>
                        <span><i class="fa fa-comment"></i> {{ $value->comments->count() }} Comments</span>
                    </div>
                </div>
            </div>
        @endforeach
        {{--End /Post or Category Slider--}}
    @endif
</div>

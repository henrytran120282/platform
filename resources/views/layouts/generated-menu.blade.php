<li class="{{ Request::is('galleries*') ? 'active' : '' }}">
    <a><i class="fa fa-sliders"></i>Galleries<span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
        <li>
            <a href="{!! route('admin.galleries.index') !!}"><i class="fa fa-list-alt"></i><span>Galleries</span></a>
        </li>
        <li>
            <a href="{!! route('admin.galleryImages.index') !!}"><i class="fa fa-image"></i><span>Gallery Images</span></a>
        </li>
    </ul>
</li>
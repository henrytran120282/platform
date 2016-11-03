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


<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{!! route('admin.contacts.index') !!}"><i class="fa fa-envelope"></i><span>Contacts</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('admin.roles.index') !!}"><i class="fa fa-user"></i><span>Roles</span></a>
</li>





<?php
return array(
    'administrator' => array(
        'content-manager'=>array(
            'manage-page' => array(
               'view','add','edit','update','delete'
            ),
            'manage-post' => array(
                'view','add','edit','update','delete'
            ),
            'manage-category' => array(
                'view','add','edit','update','delete'
            ),
            'manage-tag' => array(
                'view','add','edit','update','delete'
            ),
            'manage-comment' => array(
               'approve','delete'
            ),
        ),
        'menu-manager'=>array(
            'view','add','edit','update','delete'
        ),
        'media-manager'=>array(
            'view','upload'
        ),
        'media-manager'=>array(
            'view','upload','delete'
        ),
        'widget-manager'=>array(
            'view','add','edit','delete'
        ),
        'widget-manager'=>array(
            'slide-manager'=>array(
                'gallery-manager'=>array(
                    'add','edit','delete'
                ),
                'gallery-image-manager'=>array(
                    'add','edit','delete'
                ),
            )
        ),
        'contacts-manager'=>array(
            'view','delete'
        ),
        'roles-manager'=>array(
            'add','edit','delete'
        ),
        'users-manager'=>array(
            'add','edit','delete','edit-profile'
        ),
        'setting'=>'Setting',
    ),
    'users'=>array(
        'contacts'=>array(
            'view','send-message'
        ),
    ),
);
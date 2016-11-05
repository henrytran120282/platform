<?php
return array(
    'administrator' => array(
        'manage-page' => array(
            'page@index','page@create','page@edit','page@update','page@destroy'
        ),
        'manage-post' => array(
            'post@index','post@create','post@edit','post@update','post@destroy'
        ),
        'manage-category' => array(
            'category@index','category@create','category@edit','category@update','category@destroy'
        ),
        'manage-tag' => array(
            'tag@index','tag@create','tag@edit','tag@update','tag@destroy'
        ),
        'manage-comment' => array(
            'comment@approve','comment@destroy'
        ),
        'menu-manager'=>array(
            'menu@index','menu@create','menu@edit','menu@update','menu@destroy'
        ),
        'media-manager'=>array(
            'media@index','media@upload','media@destroy'
        ),
        'theme-manager'=>array(
            'theme@index','theme@edit','theme@destroy'
        ),
        'widget-manager'=>array(
            'widget@index','widget@create','widget@edit','widget@destroy'
        ),
        'gallery-manager'=>array(
            'gallery@index','gallery@create','gallery@edit','gallery@destroy'
        ),
        'gallery-images-manager'=>array(
            'gallery-images@index','gallery-images@create','gallery-images@edit','gallery-images@destroy'
        ),
        'contacts-manager'=>array(
            'contacts@index','contacts@destroy'
        ),
        'roles-manager'=>array(
            'roles@index','roles@create','roles@edit','roles@destroy'
        ),
        'users-manager'=>array(
            'users@create','users@edit','users@destroy','users@profile'
        ),
        'setting'=>array('setting@index'),
    ),
    'users'=>array(
        'contacts'=>array(
            'contacts@index','contacts@send-message'
        ),
    ),
);
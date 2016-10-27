<?php
/*
|--------------------------------------------------------------------------
| Config Theme Smallpine
|--------------------------------------------------------------------------
| require on config theme : 
| - name => @string
| - version => @string
| - author => @string
| - author_url => @string
| - description => @string
| - image_preview => @string
| - options => @array 
|   - name => @string
|   - type => imageupload | text | textarea | combobox
|   - *option => if type combobox else not require
|   - value => @string       
|   - label => @string
| - widget_position => @array
| - menu_position => @array
*/
return [
    /*
    *
    * General Theme
    *
    */
	'name' => 'smallpine',
    'version' => '1.0.0',
    'author' => 'QSoft Viet Nam',
    'author_url' => 'http://qsoftvietnam.com',
    'description' => 'Default Theme',
    'image_preview' => 'preview.jpg',

    /*
    *
    * Set menu position on theme
    *
    */
    'menu_position' => ['menu-top','menu-bottom','menu-left','menu-right'],

    /*
    *
    * Set widget position on theme
    *
    */
    'widget_position' => ['post_slider','sidebar'],

    /*
    *
    * Set Theme Options
    *
    */
	"options"=>[
		"general"=>[
			[
				'name'=>'logo',
                'type'=>'imageupload',
                'value'=>'Default Theme',
                'label'=>'Logo',
            ],
            [
				'name'=>'copyright',
                'type'=>'text',
                'value'=>'Copyright &copy; 2016 qsoftvietnam.com',
                'label'=>'Copyright Text',
            ],
            [
				'name'=>'customcss',
                'type'=>'textarea',
                'value'=>'',
                'label'=>'Custom CSS',
            ],
		],
		
		"social_media"=>[
			[
				'name'=>'facebook',
                'type'=>'text',
                'value'=>'',
                'label'=>'Facebook',
			],
			[
				'name'=>'twitter',
                'type'=>'text',
                'value'=>'',
                'label'=>'Twitter',
			],
			[
				'name'=>'instagram',
                'type'=>'text',
                'value'=>'',
                'label'=>'Instagram',
			],
			[
				'name'=>'youtube',
                'type'=>'text',
                'value'=>'',
                'label'=>'Youtube',
			],
		],
		
		"layouts"=>[
			[
				'name'=>'layout_style',
                'type'=>'combobox',
                'options'=>[
                    'right-sidebar'=>'Right Sidebar',
                    'left-sidebar'=>'Left Sidebar',
                    'none-sidebar'=>'None Sidebar',
                    'center-content'=>'Center Content',
                ],
                'value'=>'none-sidebar',
                'label'=>'Layout Style',
			]
		]
	]
];
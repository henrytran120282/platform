<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theme_meta')->insert([
            [
                'theme_id'   => 1,
                'meta_group' => 'options',
                'meta_key'   => 'general',
                'meta_value' => serialize([
                    [
                        'name'  => 'logo',
                        'type'  => 'imageupload',
                        'value' => '',
                        'label' => 'Logo',
                        'group' => 'general',
                    ],
                    [
                        'name'  => 'copyright',
                        'type'  => 'text',
                        'value' => 'Copyright &copy; 2016 qsoftvietnam.com',
                        'label' => 'Copyright Text',
                        'group' => 'general',
                    ],
                    [
                        'name'  => 'customcss',
                        'type'  => 'textarea',
                        'value' => '',
                        'label' => 'Custom CSS',
                        'group' => 'general',
                    ],
                ]),
            ],
            [
                'theme_id'   => 1,
                'meta_group' => 'options',
                'meta_key'   => 'social_media',
                'meta_value' => serialize([
                    [
                        'name'  => 'facebook',
                        'type'  => 'text',
                        'value' => '',
                        'label' => 'Facebook',
                        'group' => 'social_media',
                    ],
                    [
                        'name'  => 'twitter',
                        'type'  => 'text',
                        'value' => '',
                        'label' => 'Twitter',
                        'group' => 'social_media',
                    ],
                    [
                        'name'  => 'instagram',
                        'type'  => 'text',
                        'value' => '',
                        'label' => 'Instagram',
                        'group' => 'social_media',
                    ],
                    [
                        'name'  => 'youtube',
                        'type'  => 'text',
                        'value' => '',
                        'label' => 'Youtube',
                        'group' => 'social_media',
                    ],
                ]),
            ],
            [
                'theme_id'   => 1,
                'meta_group' => 'options',
                'meta_key'   => 'layouts',
                'meta_value' => serialize([
                    [
                        'name'    => 'layout_style',
                        'type'    => 'combobox',
                        'options' => [
                            'right-sidebar'  => 'Right Sidebar',
                            'left-sidebar'   => 'Left Sidebar',
                            'none-sidebar'   => 'None Sidebar',
                            'center-content' => 'Center Content',
                        ],
                        'value'   => 'right-sidebar',
                        'label'   => 'Layout Style',
                        'group'   => 'layouts',
                    ],
                ]),
            ],
            [
                'theme_id'   => 1,
                'meta_group' => 'menu_position',
                'meta_key'   => 'menu-top',
                'meta_value' => 'main-menu',
            ],
            [
                'theme_id'   => 1,
                'meta_group' => 'menu_position',
                'meta_key'   => 'menu-bottom',
                'meta_value' => '',
            ],
        ]);
    }
}

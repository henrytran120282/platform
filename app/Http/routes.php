<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::auth();

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

/*
 * Admin route after render
 */














Route::get('admin/galleries', ['as'=> 'admin.galleries.index', 'uses' => 'GalleriesController@index']);
Route::post('admin/galleries', ['as'=> 'admin.galleries.store', 'uses' => 'GalleriesController@store']);
Route::get('admin/galleries/create', ['as'=> 'admin.galleries.create', 'uses' => 'GalleriesController@create']);
Route::put('admin/galleries/{galleries}', ['as'=> 'admin.galleries.update', 'uses' => 'GalleriesController@update']);
Route::patch('admin/galleries/{galleries}', ['as'=> 'admin.galleries.update', 'uses' => 'GalleriesController@update']);
Route::delete('admin/galleries/{galleries}', ['as'=> 'admin.galleries.destroy', 'uses' => 'GalleriesController@destroy']);
Route::get('admin/galleries/{galleries}', ['as'=> 'admin.galleries.show', 'uses' => 'GalleriesController@show']);
Route::get('admin/galleries/{galleries}/edit', ['as'=> 'admin.galleries.edit', 'uses' => 'GalleriesController@edit']);


Route::get('admin/galleryImages', ['as'=> 'admin.galleryImages.index', 'uses' => 'GalleryImagesController@index']);
Route::post('admin/galleryImages', ['as'=> 'admin.galleryImages.store', 'uses' => 'GalleryImagesController@store']);
Route::get('admin/galleryImages/create', ['as'=> 'admin.galleryImages.create', 'uses' => 'GalleryImagesController@create']);
Route::put('admin/galleryImages/{galleryImages}', ['as'=> 'admin.galleryImages.update', 'uses' => 'GalleryImagesController@update']);
Route::patch('admin/galleryImages/{galleryImages}', ['as'=> 'admin.galleryImages.update', 'uses' => 'GalleryImagesController@update']);
Route::delete('admin/galleryImages/{galleryImages}', ['as'=> 'admin.galleryImages.destroy', 'uses' => 'GalleryImagesController@destroy']);
Route::get('admin/galleryImages/{galleryImages}', ['as'=> 'admin.galleryImages.show', 'uses' => 'GalleryImagesController@show']);
Route::get('admin/galleryImages/{galleryImages}/edit', ['as'=> 'admin.galleryImages.edit', 'uses' => 'GalleryImagesController@edit']);

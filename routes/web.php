<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',  'HomeController@index')->name('home');

Auth::routes();

Route::group(
    [
        'prefix' => 'client',
        'as' => 'client.',
        'namespace' => 'Client',
        'middleware' => ['auth'],
    ],
    function () {

        Route::get('', 'PostController@index')->name('home');

        Route::group([
            'prefix' => 'post',
            'as' => 'post.',
        ], function() {
            Route::get('edit/{post}', 'PostController@postFormEdit')->name('edit');
            Route::post('edit/{post}', 'PostController@postEdit');
            Route::delete('delete/{post}', 'PostController@postDelete')->name('delete');;
            Route::get('create', 'PostController@postFormCreate')->name('create');
            Route::post('create', 'PostController@postCreate');
            Route::get('sho/{post}', 'PostController@show')->name('show');
        });

    }
);

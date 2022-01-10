<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/price', 'HomeController@price')->name('price');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/register', 'HomeController@register')->name('register');
Route::get('/p/{id}', 'ProfileController@show')->name('showProfile');

Route::group(['middleware' => 'auth'], function () {
    Route::get('my-profile', 'ProfileController@myProfile')->name('myProfile');
    Route::post('my-profile-update', 'ProfileController@updateProfile')->name('myProfileUpdate');
    Route::post('password-update', 'ProfileController@changePassword')->name('changePassword');
    Route::get('shared-link', 'SharedLinkController@index')->name('sharedLink');
    Route::post('store-web-link', 'SharedLinkController@storeOrUpdateWebLink')->name('storeOrUpdateWebLink');
    Route::post('store-contact', 'SharedLinkController@storeOrUpdateContact')->name('storeOrUpdateContact');
    Route::post('store-document-link', 'SharedLinkController@storeOrUpdateDocumentLink')->name('storeOrUpdateDocumentLink');
    Route::post('set-active-link', 'SharedLinkController@setActiveLink')->name('setActiveLink');
});

Route::group(['middleware' => 'is_admin'], function () {
    // card
    Route::group(['prefix'=>'card'], function(){
        Route::get('/', 'CardController@index')->name('card');
        Route::post('/store', 'CardController@store')->name('storeCard');
        Route::put('/update/{id}', 'CardController@update')->name('updateCard');
        Route::put('/delete/{id}', 'CardController@delete')->name('deleteCard');
    });

    // package
    Route::group(['prefix'=>'package'], function(){
        Route::get('/', 'PackageController@index')->name('package');
        Route::post('/store', 'PackageController@store')->name('storePackage');
        Route::put('/update/{id}', 'PackageController@update')->name('updatePackage');
        Route::put('/delete/{id}', 'PackageController@delete')->name('deletePackage');
    });

    // user
    Route::get('user', 'UserController@index')->name('user');

});

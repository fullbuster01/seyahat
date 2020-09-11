<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('/travels', 'TravelController@all_travel')
    ->name('travels');

Route::get('/category/{category:slug}', 'TravelController@category')
    ->name('category');

Route::get('/country/{country:slug}', 'TravelController@country')
    ->name('country');

Route::get('/detail/{slug}', 'DetailController@index')
    ->name('detail');

Route::post('/checkout/{id}', 'CheckoutController@process')
    ->name('checkout_process')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create')
    ->name('checkout_create')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove')
    ->name('checkout_remove')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/confirm/{id}', 'CheckoutController@success')
    ->name('checkout_success')
    ->middleware(['auth', 'verified']);


Route::prefix('admin')
    ->namespace('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('travel-package', 'TravelPackageController');
        Route::get('travel-package-ajax', 'TravelPackageController@data_ajax')->name('travel.ajax');
        Route::resource('category', 'CategoryController');
        Route::resource('country', 'CountryController');
        Route::get('countryAjax', 'CountryController@data_ajax')->name('country.ajax');
        Route::resource('gallery', 'GalleryController');
        Route::get('galleryAjax', 'GalleryController@data_ajax')->name('gallery.ajax');
        Route::resource('thumb', 'ThumbController');
        Route::get('thumbAjax', 'ThumbController@data_ajax')->name('thumb.ajax');
        Route::resource('transaction', 'TransactionController');
        Route::get('transactionAjax', 'TransactionController@data_ajax')->name('transaction.ajax');
    });

Auth::routes(['verify' => true]);


Route::get('auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');

Route::get('auth/activate/resend', 'Auth\ActivationResendController@showresendForm')->name('auth.activate.resend');
Route::post('auth/activate/resend', 'Auth\ActivationResendController@resend');

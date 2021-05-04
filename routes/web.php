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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'Admin\AdminController@profile')->name('profile')->middleware('auth');
Route::get('/edit/profile/{id}', 'Admin\AdminController@edit_profile')->name('profile.edit')->middleware('auth');
Route::post('/update/profile/{id}', 'Admin\AdminController@update_profile')->name('profile.update')->middleware('auth');
Route::post('/update/password/{id}', 'AdminController@update_password')->name('profile.password.update');

Route::group(['prefix'=>'admin', 'middleware'=>['admin','auth'], 'namespace'=>'admin'], function(){
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    // Route::get('/profile', 'AdminController@profile')->name('superadmin.profile');
    // Route::post('/update/profile/{id}', 'AdminController@update_profile')->name('superadmin.profile.update');
    // Route::post('/update/password/{id}', 'AdminController@update_password')->name('superadmin.password.update');

    /// Zilla ///
    Route::resource('zilla', 'ZillaController');
    Route::get('delete-zilla/{id}', 'ZillaController@delete_zilla')->name('zilla.delete');

    /// Module ///
    Route::resource('module', 'ModuleController');
    Route::get('delete-module/{id}', 'ModuleController@delete_module')->name('module.delete');
    /// Registration ///
    Route::get('allAdmin', 'ModuleController@all_admin')->name('allAdmin');
    Route::get('allAdmin/registration', 'ModuleController@all_admin_registration')->name('allAdmin.registration');
    Route::post('dcAdmin/registration', 'ModuleController@dc_admin_registration')->name('dcAdmin.registration');

    //// DC Admins ////
    Route::resource('dcs', 'DcAdminController');
    Route::get('delete-dcs/{id}', 'DcAdminController@delete_dc')->name('dcs.delete');

});

Route::group(['prefix'=>'user', 'middleware'=>['user','auth'], 'namespace'=>'user'], function(){
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard');
});

Route::group(['prefix'=>'dc', 'middleware'=>['dc', 'auth'], 'namespace'=>'admin'], function(){

    Route::get('/dashboard', 'DcController@index')->name('dc.dashboard');

    /// Upazill ///
    Route::resource('upazilla', 'UpazillaController');
    Route::get('delete-upazilla/{id}', 'UpazillaController@delete_upazilla')->name('upazilla.delete');

    // /// Pouroshava ///
    Route::resource('pouroshava', 'PouroshavaController');
    Route::get('delete-pouroshava/{id}', 'PouroshavaController@delete_pouroshava')->name('pouroshava.delete');

    //// UNO Admins ////
    Route::resource('unos', 'UnoAdminController');
    Route::get('delete-unos/{id}', 'UnoAdminController@delete_uno')->name('unos.delete');
    Route::post('get-upazilla', 'UnoAdminController@get_upazilla')->name('unos.zilla.upazilla');

    //// Pouroshava Admins ////
    Route::resource('pouroAdmin', 'PouroAdminController');
    Route::get('delete-pouroAdmin/{id}', 'PouroAdminController@delete_pouro_admin')->name('pouroAdmin.delete');
    Route::post('get-pouroshava', 'PouroAdminController@get_pouroshava')->name('pouroAdmin.zilla.pouroshava');
});

Route::group(['prefix'=>'uno', 'middleware'=>['uno', 'auth'], 'namespace'=>'admin'], function(){
    
    Route::get('/dashboard', 'UnoController@index')->name('uno.dashboard');
    /// Union ///
    Route::resource('union', 'UnionController');
    Route::get('delete-union/{id}', 'UnionController@delete_union')->name('union.delete');
    Route::post('get-upazilla', 'UnionController@get_upazilla')->name('union.zilla.upazilla');

    //// Union Parishad Admins ////
    Route::resource('unionParishads', 'UnionParishadController');
    Route::get('delete-unionParishads/{id}', 'UnionParishadController@delete_unionParishads')->name('unionParishads.delete');
    Route::post('get-upazilla', 'UnionParishadController@get_upazilla')->name('unionParishads.zilla.upazilla');
    Route::post('get-union', 'UnionParishadController@get_union')->name('unionParishads.zilla.upazilla.union');
});

Route::group(['prefix'=>'mayor', 'middleware'=>['mayor', 'auth'], 'namespace'=>'admin'], function(){

    Route::get('/dashboard', 'MayorController@index')->name('mayor.dashboard');
    /// Ward ///
    Route::resource('ward', 'WardController');
    Route::get('delete-ward/{id}', 'WardController@delete_ward')->name('ward.delete');
    Route::post('get-pouroshava', 'WardController@get_pouroshava')->name('ward.pouroshava');

    //// Pouroshava Assesor Admins ////
    Route::resource('pouro_assesors', 'PouroshavaAssesorController');
    Route::get('delete-pouro_assesors/{id}', 'PouroshavaAssesorController@delete_pouro_assesors')->name('pouro_assesors.delete');
    Route::post('assesor-pouroshava', 'PouroshavaAssesorController@get_pouroshava')->name('pouro_assesors.zilla.pouroshava');
    Route::post('assesor-ward', 'PouroshavaAssesorController@get_ward')->name('pouro_assesors.zilla.pouroshava.ward');
});

Route::group(['prefix'=>'chairman', 'middleware'=>['chairman', 'auth'], 'namespace'=>'admin'], function(){

    Route::get('/dashboard', 'ChairmanController@index')->name('chairman.dashboard');
});

Route::group(['prefix'=>'councilor', 'middleware'=>['councilor', 'auth'], 'namespace'=>'admin'], function(){

    Route::get('/dashboard', 'CouncilorController@index')->name('councilor.dashboard');
});
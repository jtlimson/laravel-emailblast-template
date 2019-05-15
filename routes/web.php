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
Route::get('/', function(){  
  return view('home');
});

// *** Manage-Subscription *** //
Route::get('unsub/{email}/{pin}/', 'UnsubscriberController@unsub');
Route::post('update', 'UnsubscriberController@updatesub')->name('update');
// *** Link-Unsubscribe *** //
Route::post('unsub/{email}/{pin}/{unsubscription}', 'UnsubscriberController@unsubscribe')->name('unsubscribe');
Route::get('unsub/{email}/{pin}/{unsubscription}', 'UnsubscriberController@unsubscribe')->name('unsubscribe');

Route::get('subscribe', function(){
  return view('subscribers.resubscribe');
});
Route::post('subscribe', 'SubscriberController@resubscribe')->name('subscribe');

/**
 * Unsubscription view report
 * TODO: 
 * 1.) List of unsubscribed users
 * 2.) 
 */
Route::get('unsubscribed','UnsubscriberController@show')->name('unsubscribed.users');

//importcsv
Route::get('import','ImportCsvController@import')->name('import');
Route::post('import','ImportCsvController@upload')->name('import');

//blasting page
Route::get('sbc/list', 'SubscriberController@show' )->name('sbc.list');
Route::post('blastoff', 'SubscriberController@blastoff')->name('blastoff'); //send 
Route::post('blast', 'SubscriberController@blast')->name('preview'); //preview emails

//Templating
Route::get('tp', 'TemplateController@index')->name('tp.index');
Route::get('tp/show', 'TemplateController@show')->name('tp.show'); 
Route::get('tp/edit/{id}', 'TemplateController@edit')->name('tp.edit');
Route::post('tp/create', 'TemplateController@create')->name('tp.create');
Route::post('tp/update', 'TemplateController@update')->name('tp.update');
Route::post('tp/delete', 'TemplateController@destroy')->name('tp.delete');

//TODO: categories
Route::get('c','CategoryController@index')->name('c.index');
Route::get('c/show','CategoryController@show')->name('c.show');
Route::get('c/edit/{id}','CategoryController@edit')->name('c.edit');
Route::post('c/create','CategoryController@create')->name('c.create');
Route::post('c/update','CategoryController@update')->name('c.update');
Route::post('c/delete/{id}','CategoryController@destroy')->name('c.delete');

//TODO: batch
Route::get('b','BatchController@index')->name('b.index');
Route::get('b/show','BatchController@show')->name('b.show');
Route::get('b/edit/{id}','BatchController@edit')->name('b.edit');
Route::post('b/create','BatchController@create')->name('b.create');
Route::post('b/update','BatchController@update')->name('b.update');
Route::post('b/delete/{id}','BatchController@destroy')->name('b.delete');
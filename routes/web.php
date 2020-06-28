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


Route::get('/', 'ProxyController@index')->name("proxies");
Route::get('/providers', 'ProviderController@index')->name("providers");
Route::get('createProxies/{id?}', 'ProxyController@create')->name('createProxies');
Route::get('/testUrl', 'TestUrlController@index')->name("testurls");
Route::get('/getUrl', 'TestUrlController@viewTestUrl')->name("getUrl");

Route::post('/testip', 'TestUrlController@testIP')->name("testIP");

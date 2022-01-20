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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// トップページ
Route::get('/top', 'TopController@index')->name('top.index');

// 路線検索
Route::get('/route/serch','RouteController@serch')->middleware('keyword');
// 駅名検索
Route::get('/station/serch','StationController@serch')->middleware('keyword');
// 都道府県検索
Route::get('/prefecture/serch','PrefectureController@serch')->middleware('keyword');
// 駅名の出力
Route::post('/output/station','StationOutputController@view');
// 市町村区の出力
Route::post('/output/municipality','MunicipalityOutputController@view');

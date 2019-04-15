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

Route::get('/', 'ViewController@dtesting')->name('d_testing');

Route::get('pupdate/','ViewController@pupdate')->name('p_update');

Route::get('pview/', 'ViewController@pview')->name('p_view');



Route::get('bnew/{err?}','ViewController@bnew')->name('b_new');

Route::get('bupdate/{err?}','ViewController@bupdate')->name('b_update');

Route::get('breport/','ViewController@breport')->name('bug_report');

Route::get('binfo/','ViewController@binfo')->name('b_info');



//Add data
Route::group(['as'=>'add','prefix'=>'add'],function(){
    Route::post('project','ActionController@addproject')->name('project');
    Route::post('url','ActionController@addurl')->name('url');
    Route::post('category','ActionController@addcategory')->name('category');
    Route::post('bug','ActionController@addbug')->name('bug');
    Route::post('newbug','ActionController@addnewbug')->name('newbug');
});

//Delete data
Route::group(['as'=>'delete','prefix'=>'delete'],function(){
    Route::post('url','ActionController@deleteurl')->name('url');
    Route::post('project','ActionController@deleteproject')->name('project');
    Route::post('bug','ActionController@deletebug')->name('bug');
});

//Update data
Route::group(['as'=>'update','prefix'=>'update'],function(){
    Route::post('project','ActionController@updateproject')->name('project');
    Route::post('bug','ActionController@updatebug')->name('bug');
    Route::post('testing','ActionController@updatetesting')->name('testing');
});

//Get data
Route::group(['as'=>'get','prefix'=>'get'],function(){
    Route::post('bug','ActionController@getbug')->name('bug');
    Route::post('bugall','ActionController@getbugall')->name('bugall');
});

//Tools
Route::group(['as'=>'tool','prefix'=>'tool'],function(){
    Route::get('cors',function(){return view('tool/cors');} )->name('cors');
    Route::get('clickjacking',function(){return view('tool/clickjacking');} )->name('clickjacking');
});


Route::post('testingcookie','ActionController@testingcookie')->name('testingcookie');

Route::post('reportsubmit','ActionController@reportsubmit')->name('reportsubmit');

Route::post('additem','ActionController@additem')->name('additem');

Route::post('catsprogress','ActionController@catsprogress')->name('catsprogress');

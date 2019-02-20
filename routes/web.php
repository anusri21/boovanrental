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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'Auth\AuthController@login')->name('login.submit');

Route::get('/logout', function() {
    auth()->logout();
     return redirect('/');
});
Route::get('/','HomeController@login');

Route::group(['prefix' => 'admin'], function(){
    Route::get('clientlist','HomeController@clientlist');
    Route::get('clientview/{id}','HomeController@clientview');

    Route::get('addclient','HomeController@addclient');
    Route::post('addclient','AdminController@addclient');
    Route::get('viewclient/{id}','HomeController@viewclient');
    Route::get('editclient/{id}','HomeController@editclient');
    Route::get('deleteclient/{id}','HomeController@deleteclient');

    Route::post('addsystemdetails/{id}','AdminController@addsystemdetails');
    Route::post('editsystemdetails','AdminController@editsystemdetails');
    Route::get('viewsystemdetl/{id}','AdminController@viewsystemdetl');

    Route::get('addService','HomeController@addService');
    Route::post('saveService','AdminController@saveService');
    Route::get('servicelist','HomeController@servicelist');
    Route::get('getservice/{id}','AdminController@getservice');
    Route::get('deleteservice/{id}','HomeController@deleteservice');

    Route::get('deletesystem/{id}','HomeController@deletesystem');
    Route::get('getsysedit/{id}','HomeController@getsysedit');
    Route::get('getsysedit/{id}','HomeController@getsysedit');

    Route::get('userlist','HomeController@userlist');
    Route::post('adduser','AdminController@adduser');
    Route::get('getuser/{id}','AdminController@getuser');
    Route::post('updateUser','AdminController@updateUser');
    Route::get('deleteuser/{id}','HomeController@deleteuser');
    Route::get('viewservice/{id}','HomeController@viewservice');

    Route::post('savecomments','AdminController@savecomments');

    Route::get('userleadslist','HomeController@userleadlist');
    Route::post('adduserlead','AdminController@adduserlead');
    Route::get('editlead/{id}','AdminController@editlead');
    Route::get('deletelead/{id}','HomeController@deletelead');

    Route::get('amountlist', 'HomeController@amountlist');
    Route::post('addamount','AdminController@addamount');
    Route::get('editamount/{id}','AdminController@editamount');
    Route::post('updateamount','AdminController@updateamount');
    Route::get('deleteamount/{id}','HomeController@deleteamount');

    




  





});

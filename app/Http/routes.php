<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/localtest', function () {
    return view('test');
})->name('localtest');

Route::get('/test','TestController@test')->name('test');

Route::get('/test2','TestController@test2')->name('test2');

Route::get('/test3','TestController@test3')->name('test3');


Route::get('/test4', function () {
    return view('test');
});


Route::get('/test5', function () {
    return view('smart.layim');
});


Route::post('/test4/create','TestController@test4')->name('test4.create');



Route::get('/ajax', function () {
    return view('ajax');
});


Route::post('/ajax/create','UserController@ajax')->name('ajax');



Route::get('/contact', 'ContactController@show')->name('contact');

Route::get('/startserver', 'ContactController@startserver')->name('startserver');




Route::post('/addfriend', 'ContactController@addfriend')->name('addfriend');



Route::post('/searchfriend', 'ContactController@searchfriend')->name('searchfriend');


Route::post('/addfriendprocess', 'ContactController@addfriendprocess')->name('addfriendprocess');



Route::post('/getprocess', 'ContactController@getprocess')->name('getprocess');

Route::post('/refreshfriend', 'ContactController@refreshfriend')->name('refreshfriend');

Route::post('/deletefriend', 'ContactController@deletefriend')->name('deletefriend');


Route::post('/handlemessage', 'ContactController@handlemessage')->name('handlemessage');


Route::post('/handlefile', 'ContactController@handlefile')->name('handlefile');


//Route::get('/addfriend', 'ContactController@addfriend')->name('contact');

//Route::get('/uploads/admin/ison/{filename}', function ($user, $filename) {
//    return view('test');
//});


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test2', function () {
    return view('test2');
});

// 	Route::get('/index',function(){
// 		return view('smart.index');
// 	})->name('index');


Route::get('/localization/{locale}','LocalizationController@index');


Route::get('/getBaseInfo','ContactController@getBaseInfo')->name('getBaseInfo');


Route::post('/findfriends','ContactController@findfriends')->name('findfriends');



Route::post('/addafriend','ContactController@addafriend')->name('addafriend');


Route::get('/index','GlobalController@index')->name('index');

Route::get('/admin','AdminController@admin')->name('admin');

Route::post('/deletefilebyadmin','AdminController@deletefilebyadmin')->name('deletefilebyadmin');



Route::post('/deleteuserbyadmin','AdminController@deleteuserbyadmin')->name('deleteuserbyadmin');


Route::get('/resetpassword','UserController@resetpassword')->name('resetpassword');


Route::get('/resetbyemail','UserController@resetbyemail')->name('resetbyemail');


Route::post('/login','UserController@login')->name('login');

Route::post('/refresh','FileController@refresh')->name('refresh');


Route::post('/register','UserController@register')->name('register');

Route::post('/findpassword','UserController@findpassword')->name('findpassword');

Route::get('/main','UserController@main')->name('main');

Route::get('/uplinglist','FileController@showupinglist')->name('upinglist');
Route::get('/downinglist','FileController@showdowninglist')->name('downinglist');
Route::get('/fileshared','FileController@showfileshared')->name('fileshared');
Route::get('/trashlist','FileController@showtrashlist')->name('trashlist');
Route::post('/emailexisthint','UserController@emailexisthint')->name('emailexisthint');
Route::get('/signout','UserController@signout')->name('signout');
Route::resource('/files','FileController');
Route::get('/file/download','FileController@download')->name('file.download');


Route::get('/contact/download','ContactController@download')->name('contact.download');




Route::post('/file/update/desc','FileController@updatedesc');

Route::post('/file/delete','FileController@deletefile');

Route::post('/file/destroyfile','FileController@destroyfile');

Route::post('/file/putback','FileController@putback');

Route::post('/file/emptytrash','FileController@emptytrash');


Route::post('/file/movetofolders','FileController@movetofolders');


Route::post('/file/allintotrash','FileController@allintotrash');

Route::post('/file/createfolder','FileController@createfolder');

Route::post('/file/clearuplist','FileController@clearuplist');


Route::post('/file/alterfoldername','FileController@alterfoldername');

Route::post('/sharelink','FileController@sharelink');
Route::post('/storeqrpath','FileController@storeqrpath');

Route::post('/altershare','FileController@altershare');

Route::post('/deleteshare','FileController@deleteshare');

Route::get('/entersharepass','FileController@entersharepass');

Route::post('/checksharepass','FileController@checksharepass');



Route::post('/altervalidtime','FileController@altervalidtime');
Route::post('/altersharepass','FileController@altersharepass');




Route::get('/s/{sharelink}','FileController@showshare')->middleware('sharelink');


Route::get('/{fileid}','FileController@display')->name('display');


Route::get('/oldindex',function (){
    return view('smart.oldindex');
});




/*
 this above line is equal to

 Route::get('/files', 'FileController@index')->name('files.index');
 Route::get('/files/{id}', 'FileController@show')->name('files.show');
 Route::get('/files/create', 'FileController@create')->name('files.create');
 Route::post('/files', 'FileController@store')->name('files.store');
 Route::get('/files/{id}/edit', 'FileController@edit')->name('files.edit');
 Route::patch('/files/{id}', 'FileController@update')->name('files.update');
 Route::delete('/files/{id}', 'FileController@destroy')->name('files.destroy');

 */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

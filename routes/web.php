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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/active/admin/{id}/{value}', 'Admin\AdminController@activate');
Route::get('/active/user/{id}/{value}', 'Admin\UsersController@activate');
Route::get('/active/teacher/{id}/{value}', 'Admin\TeachersController@activate');
Route::get('/active/course/{id}/{value}', 'Admin\CoursesController@activate');
Route::get('/active/test/{id}/{value}', 'Admin\TestsController@activate');
Route::get('/active/question/{id}/{value}', 'Admin\QuestionsController@activate');
Route::get('/active/article/{id}/{value}', 'Admin\ArticlesController@activate');
Route::get('/active/news/{id}/{value}', 'Admin\NewsController@activate');

Route::get('/search/in/admins/{value}', 'Admin\SearchController@searchInAdmin');
Route::get('/search/in/users/{value}', 'Admin\SearchController@searchInUsers');
Route::get('/search/in/courses/{value}', 'Admin\SearchController@searchInCourses');
Route::get('/search/in/teachers/{value}', 'Admin\SearchController@searchInTeachers');
Route::get('/search/in/first/teachers/{value}', 'Admin\SearchController@searchInFirstsTeachers');
Route::get('/search/in/tests/{value}', 'Admin\SearchController@searchInTests');
Route::get('/search/in/news/{value}', 'Admin\SearchController@searchInNews');
Route::get('/search/in/articles/{value}', 'Admin\SearchController@searchInArticles');
Route::get('/search/in/user/messages/{value}', 'Admin\SearchController@searchInMessages');
Route::get('/search/in/questions/{value}/{test_id}', 'Admin\SearchController@searchInQuestions');
Route::get('/read/message/{id}', 'Admin\MessagesController@read');

//Ajax for search phone number
Route::post('/search/phone', 'Admin\AdminController@searchPhoneNumber')->name('admin.searchPhoneNumber');
Route::get('result/search/phone', 'Admin\AdminController@resultSearchPhoneNumber')->name('admin.resultSearchPhoneNumber');

Route::prefix('admin')->group(function() {

    //messages
    Route::get('messages','Admin\MessagesController@messages')->name('messages.index');

    //admin
    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/show/all', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/admin/create', 'Admin\AdminController@create')->name('admin.create');
    Route::post('/admin/store', 'Admin\AdminController@store')->name('admin.store');
    Route::get('/edit/{user}', 'Admin\AdminController@editAdmins')->name('admin.editAdmins');
    Route::patch('/{user}', 'Admin\AdminController@updateAdmin')->name('admin.updateAdmin');
    Route::post('/admin/show/all/search', 'Admin\AdminController@search')->name('admin.search');

    //user
    Route::resource('user','Admin\UsersController');

    //course
    Route::resource('course','Admin\CoursesController');

    //test
    Route::resource('test','Admin\TestsController');

    //test
    Route::get('/question/{test}/index', 'Admin\QuestionsController@index2')->name('question.index2');
    Route::get('/create/{test}/new/question', 'Admin\QuestionsController@createNew')->name('question.createNew');
    Route::resource('question','Admin\QuestionsController');

    //teacher
    Route::get('/teacher/index', 'Admin\TeachersController@index2')->name('teacher.index2');
    Route::resource('teacher','Admin\TeachersController');

    //articles
    Route::resource('articles','Admin\ArticlesController');

    //news
    Route::resource('news','Admin\NewsController');

    //photos
    Route::get('/photo/{id}/user', 'Admin\PhotosController@addPhotosForm')->name('photos.addPhotosForm');
    Route::delete('/user/{id}/destroy/photo', 'Admin\PhotosController@destroyPhoto')->name('photos.destroyPhoto');
    Route::post('/add/{id}/photos', 'Admin\PhotosController@addPhotos')->name('photos.addPhotos');

    //setting
    Route::post('/update/setting','Admin\SettingController@update')->name('setting.update');
    Route::get('/setting/show/all','Admin\SettingController@index')->name('setting.index');
    Route::get('/setting/{id}/edit','Admin\SettingController@edit')->name('setting.edit');
});

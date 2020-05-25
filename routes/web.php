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
Route::post('/upload/photo/summernote', 'Admin\PhotosController@summernoteUploadPhoto');

Route::get('/active/admin/{id}/{value}', 'Admin\AdminController@activate');
Route::get('/active/user/{id}/{value}', 'Admin\UsersController@activate');
Route::get('/active/teacher/{id}/{value}', 'Admin\TeachersController@activate');
Route::get('/active/course/{id}/{value}', 'Admin\CoursesController@activate');
Route::get('/active/test/{id}/{value}', 'Admin\TestsController@activate');
Route::get('/active/question/{id}/{value}', 'Admin\QuestionsController@activate');
Route::get('/active/article/{id}/{value}', 'Admin\ArticlesController@activate');
Route::get('/active/news/{id}/{value}', 'Admin\NewsController@activate');
Route::get('/active/present/{id}/{value}', 'Admin\PresentCoursesController@activate');
Route::get('/active/submit/{id}/{value}', 'Admin\SubmitsController@activate');
Route::get('/active/result/{id}/{value}', 'Admin\ResultsController@activate');

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
Route::get('/search/in/presents/{value}', 'Admin\SearchController@searchInPresents');
Route::get('/search/in/payments/{value}', 'Admin\SearchController@searchInPayments');
Route::get('/search/in/clearing/{value}', 'Admin\SearchController@searchInClearing');
Route::get('/search/in/results/{value}', 'Admin\SearchController@searchInResults');

Route::get('/confirm/financial/{id}', 'Admin\FinancialController@confirm');
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
    Route::get('/profile/{user}/show', 'Admin\AdminController@profile')->name('admin.profile');
    Route::get('/edit/{user}', 'Admin\AdminController@editAdmins')->name('admin.editAdmins');
    Route::patch('/{user}', 'Admin\AdminController@updateAdmin')->name('admin.updateAdmin');
    Route::post('/admin/show/all/search', 'Admin\AdminController@search')->name('admin.search');

    //user
    Route::get('/user/educational/status', 'Admin\UsersController@userEducationalStatus')->name('user.userEducationalStatus');
    Route::get('/user/my/profile', 'Admin\UsersController@myProfile')->name('user.myProfile');
    Route::get('/user/my/submits', 'Admin\UsersController@mySubmits')->name('user.mySubmits');
    Route::get('/user/my/course', 'Admin\UsersController@myCourse')->name('user.myCourse');
    Route::get('/user/my/test', 'Admin\UsersController@myTest')->name('user.myTest');
    Route::get('/user/show/{id}/test', 'Admin\UsersController@showResult')->name('user.showResult');
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
    Route::get('/user/{id}/educational/tree', 'Admin\TeachersController@userEducationalTree')->name('teacher.userEducationalTree');
    Route::get('/teacher/educational/tree', 'Admin\TeachersController@educationalTree')->name('teacher.educationalTree');
    Route::get('/teacher/index', 'Admin\TeachersController@index2')->name('teacher.index2');
    Route::get('/teacher/my/profile', 'Admin\TeachersController@myProfile')->name('teacher.myProfile');
    Route::get('/teacher/my/course', 'Admin\TeachersController@myCourse')->name('teacher.myCourse');
    Route::get('/teacher/my/request', 'Admin\TeachersController@myRequest')->name('teacher.myRequest');
    Route::get('/teacher/my/test', 'Admin\TeachersController@myTest')->name('teacher.myTest');
    Route::get('/teacher/show/{id}/test', 'Admin\TeachersController@showResult')->name('teacher.showResult');
    Route::resource('teacher','Admin\TeachersController');

    //articles
    Route::resource('articles','Admin\ArticlesController');

    //news
    Route::resource('news','Admin\NewsController');

    //financial
    Route::resource('financial','Admin\FinancialController');

    //clearing
    Route::get('/create/{id}/clearing', 'Admin\ClearingsController@createTwo')->name('clearing.createTwo');
    Route::resource('clearing','Admin\ClearingsController');

    //clearing
    Route::resource('result','Admin\ResultsController');

    //present
    Route::resource('present','Admin\PresentCoursesController');

    //payment
    Route::resource('payment','Admin\PaymentsController');

    //submit
    Route::get('/submit/{id}/list', 'Admin\SubmitsController@index2')->name('submit.index2');
    Route::resource('submit','Admin\SubmitsController');

    //student
    Route::get('/student/{id}/list', 'Admin\StudentsController@indexTwo')->name('student.indexTwo');
    Route::get('/add/student/to/{id}/list', 'Admin\StudentsController@storeTow')->name('student.storeTow');
    Route::resource('student','Admin\StudentsController');

    //photos
    Route::get('/photo/{id}/user', 'Admin\PhotosController@addPhotosForm')->name('photos.addPhotosForm');
    Route::delete('/user/{id}/destroy/photo', 'Admin\PhotosController@destroyPhoto')->name('photos.destroyPhoto');
    Route::post('/add/{id}/photos', 'Admin\PhotosController@addPhotos')->name('photos.addPhotos');

    //setting
    Route::post('/update/setting','Admin\SettingController@update')->name('setting.update');
    Route::get('/setting/show/all','Admin\SettingController@index')->name('setting.index');
    Route::get('/setting/{id}/edit','Admin\SettingController@edit')->name('setting.edit');
});

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
//

Route::get('/', 'PageController@home')->name('home_page');
Route::get('/dang-ki-giao-vien', 'PageController@getRegistrationTeacher')->name('get_registration_teacher');
Route::post('/dang-ki-giao-vien', 'PageController@postRegistrationTeacher')->name('post_registration_teacher');

Route::get('/dang-ki-hoc-vien', 'PageController@getRegistrationStudent')->name('get_registration_student');
Route::post('/dang-ki-hoc-vien', 'PageController@postRegistrationStudent')->name('post_registration_student');

Route::get('/tu-luyen', 'PageController@selfTraining')->name('self-training');
Route::get('/thi-tu-do', 'PageController@training')->name('training');
Route::post('/thi-tu-do', 'PageController@postTraining')->name('post.training');

Route::get('/admin-login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::get('/dang-nhap', 'Auth\LoginController@showLoginForm')->name('user.login');

Route::post('admin-login', 'Auth\AdminLoginController@login')->name('post.login_admin');
Route::get('logout-admin', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('bai-thi/{id}/question/{id_question}', 'PageController@getExam')->name('get.exam');
Route::get('bai-thi/{id}/{id_user}/result', 'PageController@getExamResult')->name('get.result');

Route::post('save/{id}/{id_user}/result', 'PageController@saveResult')->name('save_test');

Route::get('bang-xep-hang', 'PageController@ranKing')->name('get.ranking');
Route::post('bang-xep-hang', 'PageController@postRanKing')->name('post.ranking');

Route::get('xem-ket-qua', 'PageController@getResult')->name('results');

Route::post('save-answer/{id}', 'PageController@saveAnswer')->name('save-answer');
Route::get('tin-tuc/{id}', 'PageController@getCateNews')->name('tin-tuc');
Route::get('chi-tiet-tin/{id}', 'PageController@newsDetail')->name('news-detail');

Route::post('save-result', 'PageController@saveResult')->name('save-result');

Route::get('video-chua-de-thi', 'PageController@listVideo')->name('lists.video');
Route::get('tai-khoan/{id}', 'PageController@getAcount')->name('acount.get');
Route::post('tai-khoan/{id}', 'PageController@updateAcount')->name('acount.update');
Route::get('gop-y-he-thong', 'PageController@getFeedback')->name('user.get_feedback');
Route::post('gop-y-he-thong', 'PageController@sendfeedback')->name('user.send_feedback');
Route::post('doi-mat-khau/{id}', 'PageController@updatePassword')->name('acount.update_password');

Route::post('lam-lai', 'PageController@Retest')->name('test.retest');
Route::post('ghi-ket-qua', 'PageController@saveResultRound')->name('save.result_round');

Route::get('quen-mat-khau-user', 'Auth\ForgotPasswordController@getForgotPasswordUser')->name('get.forgot_password_user');
Route::post('quen-mat-khau-user', 'Auth\ForgotPasswordController@postForgotPasswordUser')->name('post.forgot_password_user');
Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

Route::get('teacher-login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');

Route::get('teacher-logout', 'Auth\TeacherLoginController@logout')->name('teacher.logout');

Route::post('teacher-login', ['as' => 'teacher-login', 'uses' => 'Auth\TeacherLoginController@login']);

Route::get('/dashboard-teacher', 'TeacherController@dasboard')->name('teacher-dashboard');

Route::get('/test-list', 'TeacherController@getTestListByTeacher')->name('teacher-test-list');


Route::prefix('question')->group(function () {
    Route::get('/', 'QuestionController@getList')->name('question.all_list');
    Route::get('/test/{id}', 'QuestionController@index')->name('question.list');
    Route::get('/test/{id}/add', 'QuestionController@getAdd')->name('question.get_add');
    Route::post('/test/{id}/add', 'QuestionController@postAdd')->name('question.post_add');
    route::get("/test/{id_test}/edit/{id}", "QuestionController@getEdit")->name("question.get_edit");
    route::post("/test/{id_test}/edit/{id}", "QuestionController@postEdit")->name("question.post_edit");
    route::get("/test/{id_test}/del/{id}", "QuestionController@getdel")->name("question.delete");
});

Route::group(['prefix' => 'admins', 'middleware' => ['admin']], function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    Route::prefix('feedback')->group(function () {
        Route::get('/', 'FeedbackController@index')->name('admin.feedback');
        route::get("/saw/{id}", "FeedbackController@saw")->name("feedback.saw");
        route::get("/del/{id}", "FeedbackController@getdel")->name("feedback.delete");
    });

    Route::prefix('question-training')->group(function () {
        Route::get('/', 'QuestionController@getQuestionTraining')->name('question_training.list');
        Route::get('/add', 'QuestionController@getAddQuestionTraining')->name('question_training.get_add');
        Route::post('/add', 'QuestionController@postAddQuestionTraining')->name('question_training.post_add');
        route::get("/edit/{id}", "QuestionController@getEditQuestionTraining")->name("question_training.get_edit");
        route::post("/edit/{id}", "QuestionController@postEditQuestionTraining")->name("question_training.post_edit");
        route::get("/del/{id}", "QuestionController@getdelQuestionTraining")->name("question_training.delete");
    });

    Route::prefix('round')->group(function () {
        Route::get('/', 'RoundController@index')->name('round.list');
        Route::get('/add', 'RoundController@getAdd')->name('round.get_add');
        Route::post('/add', 'RoundController@postAdd')->name('round.post_add');
        route::get("/edit/{id}", "RoundController@getEdit")->name("round.get_edit");
        route::post("/edit/{id}", "RoundController@postEdit")->name("round.post_edit");
        route::get("/del/{id}", "RoundController@getdel")->name("round.delete");
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('users.list');
        Route::get('/add', 'UserController@getAdd')->name('users.get_add');
        Route::post('/add', 'UserController@postAdd')->name('users.post_add');
        route::get("/del/{id}", "UserController@getdel")->name("users.delete");
    });

    Route::prefix('teachers')->group(function () {
        Route::get('/', 'TeacherController@index')->name('teachers.list');
        Route::get('/add', 'TeacherController@getAdd')->name('teachers.get_add');
        Route::post('/add', 'TeacherController@postAdd')->name('teachers.post_add');
        route::get("/del/{id}", "TeacherController@getdel")->name("teachers.delete");
        route::get("/approval/{id}", "TeacherController@Approval")->name("teachers.Approval");
    });

    Route::prefix('categories_tests')->group(function () {
        Route::get('/', 'CateTestController@index')->name('categories_tests.list');
        Route::get('/add', 'CateTestController@getAdd')->name('categories_tests.get_add');
        Route::post('/add', 'CateTestController@postAdd')->name('categories_tests.post_add');
        route::get("/edit/{id}", "CateTestController@getEdit")->name("categories_tests.get_edit");
        route::post("/edit/{id}", "CateTestController@postEdit")->name("categories_tests.post_edit");
        route::get("/del/{id}", "CateTestController@getdel")->name("categories_tests.delete");
    });

    Route::prefix('test')->group(function () {
        Route::get('/', 'TestController@index')->name('test.list');
        Route::get('/add', 'TestController@getAdd')->name('test.get_add');
        Route::post('/add', 'TestController@postAdd')->name('test.post_add');
        route::get("/edit/{id}", "TestController@getEdit")->name("test.get_edit");
        route::post("/edit/{id}", "TestController@postEdit")->name("test.post_edit");
        route::get("/del/{id}", "TestController@getdel")->name("test.delete");
    });


    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.list');
        Route::get('/add', 'CategoryController@getAdd')->name('categories.get_add');
        Route::post('/add', 'CategoryController@postAdd')->name('categories.post_add');
        route::get("/edit/{id}", "CategoryController@getEdit")->name("categories.get_edit");
        route::post("/edit/{id}", "CategoryController@postEdit")->name("categories.post_edit");
        route::get("/del/{id}", "CategoryController@getdel")->name("categories.delete");
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', 'NewsController@index')->name('posts.list');
        Route::get('/add', 'NewsController@getAdd')->name('posts.get_add');
        Route::post('/add', 'NewsController@postAdd')->name('posts.post_add');
        route::get("/edit/{id}", "NewsController@getEdit")->name("posts.get_edit");
        route::post("/edit/{id}", "NewsController@postEdit")->name("posts.post_edit");
        route::get("/del/{id}", "NewsController@getdel")->name("posts.delete");
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clear-cache', function () {
    Artisan::call('vendor:publish --tag=lfm_config');
    Artisan::call('vendor:publish --tag=lfm_public');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});
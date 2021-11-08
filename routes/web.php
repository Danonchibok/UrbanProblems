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

/*Route::get('/', function () {
    return view('main');
});*/

use App\Http\Controllers\privateAccController;
use App\Http\Middleware\admin;

Auth::routes();

Route::get('/', 'problemsController@index');

Route::get('/getCounters', 'problemsController@counters');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/privateAcc/back', 'privateAccController@back')->name('backSearch');

Route::get('/privateAcc', 'privateAccController@index')->name('privateAcc')->middleware('auth');

Route::post('/privateAcc', 'privateAccController@insertSearch')->name('insertSearch');

Route::post('/privateAcc/del', 'privateAccController@deleteProblem')->name('deleteProblem');

Route::get('/feedBack', 'FeedbackController@index')->name('feedBack')->middleware('auth');

Route::post('/feedback', 'FeedbackController@insertFeedback')->name('inFeedBack');

Route::group( [ 'middleware' => 'auth', 'middleware' => 'admin' ], function () {
    // только для админа
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/Users', 'AdminController@GetUsers')->name('getUsers');
    Route::get('/admin/Problems', 'AdminController@GetProblems')->name('getProblems');
    Route::get('/admin/Categories', 'AdminController@GetCategory')->name('getCategories');
    Route::get('/admin/solveProblemInputs', 'AdminController@GetInputsSolve')->name('getInputsSolve');
    Route::post('/admin/solveProblem', 'AdminController@SolveProblem')->name('solveProblem');
    Route::get('/admin/rejectInputs', 'AdminController@GetInputsReject')->name('getInputsReject');
    Route::post('/admin/rejectProblem', 'AdminController@RejectProblem')->name('reject');
    Route::post('/admin/DeleteCategory', 'AdminController@DeleteCategory')->name('delCategory');
    Route::get('/admin/addCategoryinput', 'AdminController@GetInputsCategory')->name('addCategoryInput');
    Route::post('/admin/addCategory', 'AdminController@AddCategory')->name('addCategoty');

});

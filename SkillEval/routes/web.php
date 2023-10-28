<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', 'UserController');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('courses', 'CourseController');
    Route::resource('reports', 'ReportsController');
    Route::resource('students', 'StudentController');
    Route::resource('classrooms', 'ClassroomController');

    Route::post('classrooms/import', 'ClassroomController@import')->name('classrooms.import');
    Route::post('students/import/{classroom}', 'StudentController@import')->name('students.import');
    Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');
    Route::get('/students/{student}/edit', 'StudentController@edit')->name('students.edit');
    Route::put('/students/{student}', 'StudentController@update')->name('students.update');

    Route::get('evaluations/create/{student}', 'EvaluationController@createForStudent')->name('evaluations.create.student');
    Route::post('evaluations/store/student', 'EvaluationController@storeForStudent')->name('evaluations.store.student');

    Route::get('evaluations/{student}/{test}/edit', 'EvaluationController@edit')->name('evaluations.edit');
    Route::put('evaluations/{student}/{test}', 'EvaluationController@update')->name('evaluations.update');

    Route::get('evaluations', 'EvaluationController@index')->name('evaluations.index');
    Route::delete('evaluations/{studentId}/{testId}', 'EvaluationController@destroy')->name('evaluations.destroy');

    Route::get('evaluations/create', 'EvaluationController@create')->name('evaluations.create');
    Route::post('evaluations/store', 'EvaluationController@store')->name('evaluations.store');
});

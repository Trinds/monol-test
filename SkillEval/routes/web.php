<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('courses', 'CourseController');
Route::resource('classrooms', 'ClassroomController');
Route::resource('students', 'StudentController');

// Route::post('/login', 'Auth\LoginController@login')->name('login');

// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('evaluations/create/{student}', 'EvaluationController@createForStudent')->name('evaluations.create.student');
Route::post('evaluations/store/student', 'EvaluationController@storeForStudent')->name('evaluations.store.student');


Auth::routes();


Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');


Route::get('/users/create', 'Auth\RegisterController@showRegistrationForm')->name('users.create');

Route::post('classrooms/import', 'ClassroomController@import')->name('classrooms.import');
Route::post('students/import/{classroom}', 'StudentController@import')->name('students.import');



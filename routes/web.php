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

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

Auth::routes();

Route::get('/test', function () {
return view('admin.panel');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
Route::get('/all-tasks', 'TaskController@index');

Route::group(['middleware' => ['role:administrator']], function() {
// show task
    Route::get('/tasks/{task_id?}', 'TaskController@show');
// add new task
    Route::post('/tasks', 'TaskController@store')->name('new-task');
    //edit
    Route::post('/tasks/{task_id?}', 'TaskController@edit');
// update task
    Route::post('/tasks/{task_id?}', 'TaskController@update');
// delete task
    Route::delete('/tasks/{task_id?}', 'TaskController@destroy');
});

Route::group(['middleware' => ['permission:users']], function (){
    Route::resource('users', 'UserController');
});

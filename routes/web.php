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
Route::get('/', 'HomeController@home' )->name('home');
Route::post('/user/register', 'registerController@register');
Route::get('/registerPage', 'HomeController@registerPage') -> name('registerPage');
Route::get('/loginPage', 'HomeController@loginPage') ->name('loginPage');
Route::post('/user/login', 'loginController@login');
Route::get('/logout', 'loginController@logOut') -> name('logout');
Route::get('/profile', 'HomeController@profile') -> name('profile');
Route::get('/editProfile', 'HomeController@editProfile') -> name('editProfile');
Route::get('/editPassword', 'HomeController@editPassword') -> name('editPassword');
Route::post('user/editProfile', 'userController@editProfile');
Route::post('user/editPassword', 'userController@editPassword');
Route::post('user/showProgress', 'userController@showProgress');
Route::get('/showProgress', 'HomeController@showProgress') ->name('showProgress');
Route::get('addProgress', 'HomeController@addProgress') ->name('addProgress');
Route::post('/user/addProgress', 'userController@addProgress');
Route::delete('/user/deleteProgress', 'userController@deleteProgress');
Route::get('/trainerList', 'HomeController@trainerList')->name('trainerList');
Route::post('/user/trainerList', 'userController@trainerList');
Route::post('/user/sendRequest', 'userController@sendRequest');
Route::post('/user/cancelRequest', 'userController@cancelRequest');
Route::get('/proteges', 'HomeController@proteges') ->name('proteges');
Route::post('/user/proteges', 'userController@proteges');
Route::post('/user/acceptRequest', 'userController@acceptRequest');
Route::get('/addDish', 'HomeController@addDish') ->name('addDish');
Route::get('/yourDishes', 'HomeController@dishes') ->name('yourDishes');
Route::post('/user/addDish', 'userController@addDish');
Route::post('/user/showDishes', 'userController@showDishes');
Route::delete('/user/deleteDish', 'userController@deleteDish');
Route::delete('/user/deleteExercise', 'userController@deleteExercise');
Route::post('/user/addExercise', 'userController@addExercise');
Route::get('/yourExercises', 'HomeController@exercises') ->name('yourExercises');
Route::get('/addExercise', 'HomeController@addExercise') ->name('addExercise');
Route::post('/user/showExercises', 'userController@showExercises');
Route::get('/createSchedule/{protege_id}', 'HomeController@createSchedule');
Route::post('/user/getDishes', 'userController@getDishes');
Route::post('/user/getExercises', 'userController@getExercises');
Route::post('/user/createSchedule', 'userController@createSchedule');
Route::get('/daySchedule', 'HomeController@daySchedule')->name('daySchedule');
Route::post('/user/showSchedules', 'userController@showSchedules');
Route::get('/messages', 'HomeController@messages')->name('messages');
Route::post('/user/getMessages', 'userController@getMessages');
Route::post('/user/getNewMessages', 'userController@getNewMessages');
Route::post('/user/sendMessage', 'userController@sendMessage');
Route::post('/user/getConversations', 'userController@getConversations');
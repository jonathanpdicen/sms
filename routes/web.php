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

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');

Route::prefix('web-api')->middleware('auth')->group(function () {
    Route::apiResource('course', Api\CourseController::class);
    Route::apiResource('event', Api\EventController::class);
    Route::apiResource('user', Api\UserController::class);
});

Route::any('/{all}', function () {
    return view('app');
})
    ->where(['all' => '[\/\w\.-]*'])
    ->where(['all' => '^(?!api\/v1.*$).*']);

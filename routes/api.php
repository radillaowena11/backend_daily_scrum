<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:api'])->get('/user', function (Request $request){

    return $request->user();
});

Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');

    Route::get('daily_scrum', 'Daily_ScrumController@daily_scrum');
    Route::get('daily_scrumall', 'Daily_ScrumController@daily_scrumAuth')->middleware('jwt.verify'); 
    Route::post('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify'); 
   



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

Route::group(['middleware' => ['jwt.verify']], function (){
    Route::get('login/check', 'UserController@LoginCheck');
    Route::post('logout', 'UserController@logout')->middleware('jwt.verify');

    Route::get('/daily_scrum/{id}', 'Daily_ScrumController@index');
    Route::post('/daily_scrum', 'Daily_ScrumController@store')->middleware('jwt.verify'); 
    Route::get('daily_scrum/{limit}/{offset}/{id_user}', "DailyController@getAll");
    Route::delete('/daily_scrum/{id}', 'Daily_ScrumController@delete')->middleware('jwt.verify'); 

});
       // Route::post('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify'); 




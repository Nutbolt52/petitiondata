<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //Home page
    Route::get('/', 'PetitionData@home');
    //Petition Specific Page
    Route::post('/petition', 'PetitionData@RequestData');
    Route::get('/{petitionID}', 'PetitionData@GetAndDisplayData');
    //Routes for table data
    Route::get('/api/{petitionID}/country', 'PetitionData@CountryData');
    Route::get('/api/{petitionID}/constituency', 'PetitionData@ConstituencyData');

});

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

Route::get('/', function () {
    return redirect(url('/home'));
});

Route::get('images/{folder}/{image}',function($folder,$image){
  $url = \Storage::disk('public')->get($folder.'/'.$image);
  return $url;
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
  Route::get('/home', 'HomeController@index');
  Route::get('/profile','ProfileController@index');
  Route::put('/profile','ProfileController@update');
  Route::group(['middleware' => 'role:judge','prefix' => 'judge'],function(){
    Route::get('/candidate/{id}','CandidateController@show');
    Route::get('/assessment','AssessmentController@index');
    Route::get('/assessment/interview','InterviewController@index');
    Route::get('/assessment/interview/add','InterviewController@create');
    Route::post('/assessment/interview','InterviewController@store');
    Route::resource('/assessment/sectionone','SectionOneController');
    Route::resource('/assessment/talent','TalentController');
    Route::resource('/assessment/sectiontwo','SectionTwoController');
    Route::resource('/assessment/sectionthree','SectionThreeController');
  });
  Route::group(['middleware' => 'role:admin','prefix' => 'admin'], function(){
    Route::resource('/candidate','CandidateController');
    Route::get('/candidaterole','CandidateRoleController@index');
    Route::get('/ticket','TicketController@index');
    Route::post('/ticket','TicketController@store');
    Route::delete('/ticket','TicketController@destroy');
    Route::get('/assessmentviews','AssessmentViewsController@index');
    Route::resource('/users','UserController');
    Route::get('/ticketaccess','TicketAccessController@index');
    Route::post('/ticketaccess','TicketAccessController@store');
    Route::get('/ticketaccess/{id}/delete','TicketAccessController@delete');
    Route::get('/voting','VoteController@index');
  });
  Route::group(['middleware' => 'role:crew','prefix' => 'crew'], function(){
    //Route::resource('/ticket','TicketController');
    Route::resource('/candidate','CandidateController');
    Route::get('/ticketaccess','TicketAccessController@index');
    Route::post('/ticketaccess','TicketAccessController@store');
    Route::get('/ticketaccess/{id}/delete','TicketAccessController@delete');
  });
});

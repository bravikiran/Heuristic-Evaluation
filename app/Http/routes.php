<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Application Pages
Route::get('/', 'PagesController@index');
//Route::get('about', 'PagesController@aboutpage');
Route::get('contact', 'PagesController@contactpage');
Route::get('learn', 'PagesController@learnpage');
Route::get('signup', 'PagesController@signup');
Route::post('contactAdmin', 'PagesController@contactAdmin');
Route::get('message','PagesController@message');


// User Confirmation to register in the System
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

// Invited User Registration 
Route::get('inviteuserregistration/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'InvitationRegistrationController@confirm'
]);

// Invited User Registration View to Register
Route::get('referencesignup','InvitationRegistrationController@referencesignupview');
Route::post('inviteuserregistration/verify/inviteregister','InvitationRegistrationController@referencesignup');

// User Login , Logout , and Registration Pages
Route::post('login','UserController@login');
Route::get('logout','UserController@logout');
Route::post('register',['as' => 'register', 'uses' => 'UserController@store']);


// Manager Controller
Route::get('index',['as' =>'manager', 'uses' => 'ManagerController@index']);
Route::get('read/{id}','ManagerController@notificationread');
Route::get('projects',['as' => 'managerprojects', 'uses' => 'ManagerController@projects']);
Route::get('managerprojectsstatus',['as'=>'managerprojectsstatus', 'uses' => 'ManagerController@managerprojectsstatus']);
Route::get('showprojectdetails','ManagerController@showproject');
Route::get('evaluationlogsofproject/{id}',['as' => 'projectreports', 'uses' => 'ManagerController@ProjectReports']);
Route::get('projectsreport',['as' => 'results', 'uses' => 'ManagerController@projectresults']);
Route::POST('selectedlogs', 'ManagerController@selectiongevaluationlogs');
Route::POST('saveevaluationlogs/{id}',['as' => 'saveresults', 'uses' => 'ManagerController@storeEvaluationResults']);
Route::post('IndividualProjectResult', ['as' =>'IndividualProjectResult', 'uses' => 'ManagerController@IndividualProjectResult']);
Route::post('individualprojectresultgraph', 'ManagerController@lavashow');
Route::post('tracking', 'ManagerController@tracking');
Route::get('projectForm',['as' => 'projectform','uses' => 'ManagerController@createForm']);
Route::post('createproject',['as' => 'createproject', 'uses' => 'ManagerController@createProject']);
Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'ManagerController@destroy']);
Route::get('deleteevaluationlogs/{id}', ['as' => 'deleteevaluationlogs', 'uses' => 'ManagerController@deleteevaluationlogs']);
Route::get('requestAccept/{id}',['as' => 'requestAccept', 'uses' => 'ManagerController@requestAccept']);
Route::get('requestDecline/{id}',['as' => 'requestDecline', 'uses' => 'ManagerController@requestDecline']);

//ManagerReferenceUsers Controller
Route::get('sendInvitationForm',['as' => 'sendInvitationForm', 'uses' => 'ReferenceController@sendInvitationForm']);
Route::POST('sendInvitation',['as' => 'sendInvitation', 'uses' => 'ReferenceController@sendInvitation']);
Route::get('usersstatus',['as' => 'usersstatus', 'uses' => 'ReferenceController@userstatus']);


// To see users profile
Route::get('profile','UserController@show');


// Adding New Heuristic Rules to the System
Route::get('huristicrules', ['as' => 'heuristicrules', 'uses' => 'NewHeuristicRulesAdd@index']);
Route::get('showhsets/{id}', ['as' =>'showtitledescription','uses' => 'NewHeuristicRulesAdd@show']);
Route::get('addheuristic',['as' => 'addheuristic', 'uses' => 'NewHeuristicRulesAdd@create']);
Route::POST('saveheuristicrules',['as' => 'saveheuristic', 'uses' =>'NewHeuristicRulesAdd@store']);
Route::get('editheuristicrule/{id}', [ 'as' => 'ruleedit', 'uses' => 'NewHeuristicRulesAdd@edit']);
Route::post('updateheuristicrules/{id}',['as' => 'updateheuristicrules', 'uses'=>'NewHeuristicRulesAdd@update']);
Route::get('deleterule/{id}',[ 'as' => 'deleterule', 'uses' =>'NewHeuristicRulesAdd@destroy']);

// Evaluator Routing
Route::get('evaluator', [ 'as' => 'evaluator', 'uses' => 'EvaluatorController@index']);
Route::get('newprojects',['as' => 'projectlist', 'uses'=> 'EvaluatorController@projects']);
Route::get('rejectedprojects',['as' => 'rejectedprojects', 'uses'=> 'EvaluatorController@rejectlist']);
Route::get('requestprojectevaluation/{id}',['as' => 'requestprojectevaluation','uses' => 'EvaluatorController@requestproject']);
Route::get('reports',['as' => 'evaluator/reports', 'uses'=> 'EvaluatorController@reports']);
Route::post('evaluationlogs/logs','EvaluatorController@store');
Route::post('evaluationlogs/lastlogs','EvaluatorController@storeLastLog');
Route::get('accept/{id}', ['as' => 'evaluator/accept', 'uses' => 'EvaluatorController@accept']);
Route::get('evaluator/acceptedprojects', ['as' => 'evaluator/acceptedprojects', 'uses' => 'EvaluatorController@accept']);
Route::get('evaluationlogs/{id}', ['as' => 'evaluationlogs', 'uses' => 'EvaluatorController@evaluationlogs']);
Route::get('evaluator/reject/{id}', ['as' => 'evaluator/reject', 'uses' => 'EvaluatorController@reject']);
Route::get('evaluatorevaluationlogs/{id}',['as' => 'evaluatorevaluationlogs', 'uses' => 'EvaluatorController@evaluatorevaluationlogs']);


// Developer Routing
Route::get('developer',['as' => 'developer', 'uses' => 'DeveloperController@index']);
Route::get('commentonlogs/{id}',['as' => 'commentonlogs/{id}','uses' => 'DeveloperController@commentonlogs']);
Route::post('savelogcomment', 'DeveloperController@savelogcomment');
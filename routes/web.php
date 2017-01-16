<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Global Setting
Route::post('hr/importjob','GlobalSettingController@csvupload');
Route::post('mod/holiday','GlobalSettingController@modholiday');
Route::get('hr/deletejob/{id}/{division}','GlobalSettingController@deletejob');
Route::post('savefiscal','GlobalSettingController@savefiscal');			
Route::get('getfiscal','GlobalSettingController@getfiscal');
Route::get('setwrkhrs','GlobalSettingController@setwrkhrs');						
Route::get('hr/assignlm/{empid}/{lmid}','GlobalSettingController@assignemp');
Route::get('hr/assignerole','GlobalSettingController@assignerole');
Route::post('hr/manualadd/{type}','GlobalSettingController@addjobdeptmanal');
Route::get('save/pilot','GlobalSettingController@managepilot');
Route::get('delete/pilot/{id}','GlobalSettingController@deletepilot');
Route::get('getleaveday','GlobalSettingController@getleaveday');
Route::get('attachleave/role','GlobalSettingController@attachleave');
Route::get('hr/getdep',function(){
	
	return app('App\Repositories\GlobalSettingRepository')->getjob(1);
	
});
Route::get('savequery','GlobalSettingController@savequery');
Route::post('modify/query','GlobalSettingController@modifyquery');
Route::post('import/emloyee','GlobalSettingController@importemployee');
Route::post('updatequestion','GlobalSettingController@updatequestion');
Route::post('modify/leave','GlobalSettingController@modifyleave');
Route::post('import/question','GlobalSettingController@csvquesupload');
Route::get('attendance/timesearch','GlobalSettingController@attendancetimesearch');
Route::get('saveleave','GlobalSettingController@saveleave');
Route::get('/deletequestion/{id}' ,'GlobalSettingController@deletequestion');
Route::get('save/holiday' ,'GlobalSettingController@saveholiday');
Route::get('test/setting','GlobalSettingController@savesetting');
Route::get('notification','GlobalSettingController@notificationsetting');
//Global Setting

Route::get('employee/list','EmployeeController@empsearchres');
Route::post('issue/query','LMController@issuequery');
Route::get('disableemp/{id}','LMController@disable');
Route::get('lm/querytype/{id}','LMController@querytype');
Route::get('dispdetail/{id}','LMController@dispdetail');
Route::get('moreemp/{skip}/{take}','LMController@moreemp');
Route::get('replyquery','LMController@replyquery');
Route::get('lm/querytype/{id}','LMController@querytype');
Route::get('querythread','LMController@querythread');
Route::post('savelisting/{type}', 'LMController@savelisting');
Route::post('sendmail', 'LMController@sendmail');
Route::get('review', 'LMController@checkDeadline');
Route::get('/home', 'HomeController@index');
Route::get('/applicant/job', 'LMController@jobapp');
Route::post('/appdisp', 'LMController@appdisp');
Route::get('employeet/pilotchart/{id}','EmployeeController@getperformance');
Route::get('setreadquery','EmployeeController@setreadquery');
Route::get('employeet/{getgoal}','EmployeeController@getgoal');
Route::get('setfy/{year}','EmployeeController@setfy');
Route::get('logout','HomeController@logout');
Route::get('lm/org', 'LMController@org');
//apptitude test routes
Route::get('/timer', 'JobController@timer');
Route::get('/count', 'JobController@countquestion');
Route::get('/applicant/submittest/{userid}/{questionid}/{selectedoption}/{jobid}', 'JobController@submittest');
Route::get('/taketest/{num}', 'JobController@displayquestionjson');
Route::get('/completed', 'JobController@completed');
Route::get('/seton', 'JobController@seton');
Route::get('/view/displcal', 'XtraController@dispcal');
Route::get('/view/document', 'XtraController@viewdoc');

//OAuth 
Route::get('/auth/microsoft', 'MicrosoftController@redirectToProvider');
Route::get('/auth/microsoft/callback', 'MicrosoftController@callbackurl');


Route::resource('employee', 'EmployeeController');
Route::resource('hr', 'GlobalSettingController');
Route::resource('lm', 'LMController');

//xtra features
Route::resource('view', 'XtraController');
Route::get('delete/document', 'XtraController@deletedoc');
Route::get('move/document', 'XtraController@movedoc');
Route::post('document/upload', 'XtraController@uploaddoc');
Route::get('searchdoc', 'XtraController@search');
Route::get('edit/folder', 'XtraController@folderedit');
Route::get('delete/folder', 'XtraController@folderdelete');

 

Route::resource('savefolder', 'XtraController@savefolder');
Route::resource('manage', 'lmabsenceController');
Route::get('leave', 'lmabsenceController@disptype');
Route::get('sort/{type}', 'lmabsenceController@sorts');
Route::get('search', 'lmabsenceController@searchleave');
Route::get('searchemp', 'LMController@searchemp');
Route::get('leave/statistics', 'lmabsenceController@leavestat');
Route::post('/abreqemp', 'EmployeeController@submitrequest');
Route::get('/modifyRequest', 'EmployeeController@modifyRequest');
Route::resource('job', 'JobController');
Route::resource('available_jobs', 'AvailJobController');
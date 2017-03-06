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

Route::get('change/{locale}','HomeController@changelang');
 

Route::group(['prefix' => Translation::getRoutePrefix(), 'middleware' => ['locale']], function()
{
Route::get('/', function () {
	if(\Auth::guest()){
	     return view('welcome');	
	}
    return redirect('home');
});
Route::get('/error',function(){
	  
	return view('errors.unauth');
});

 

Route::get('view/myevent','MicrosoftIntegration@displayevent');
Route::get('outlookevent','MicrosoftIntegration@outlookevent');
Route::get('createvent','MicrosoftIntegration@createvent');
Route::get('mailsending','MicrosoftIntegration@sendmail');

Auth::routes();

//employee 360 review
Route::get('review360','EmpController360@emplist');
Route::get('savereview','EmpController360@savereview');
Route::get('getrecentreview','EmpController360@getreview');
Route::get('rateemployee','EmpController360@rateemployee');
Route::get('countreview','EmpController360@countreview');
								  
								

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
Route::get('getsetting','GlobalSettingController@getsetting');
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

//profile management
Route::get('adddependant/{id}', 'ProfileController@adddependant'); 
Route::get('deletedpendant/{id}', 'ProfileController@deletedependant');

//SKILL MNIPULATION
Route::get('addskills/{id}', 'ProfileController@addskills');  
Route::get('deleteskills/{id}', 'ProfileController@deleteskills'); 
//SKILL MNIPULATION ENDS

//ACADEMICS MANIPULATION
Route::get('addacademics/{id}', 'ProfileController@addacademics');  
Route::get('deleteacademics/{id}', 'ProfileController@deleteacademics'); 
//ACADEMICS MANIPULATION


//PAST EXPERIENCES
Route::get('addexperience/{id}', 'ProfileController@addexperiences');  
Route::get('deleteexperience/{id}', 'ProfileController@deleteexperiences'); 
//PAST EXPERIENCES

Route::get('updateprofile', 'ProfileController@updateprofile'); 
Route::post('/change/password','ProfileController@changepassword');
Route::post('update/picture','ProfileController@changepicture');
	 						 
Route::resource('savefolder', 'XtraController@savefolder');
Route::resource('manage', 'lmabsenceController');

//PROJECT MANAEMENT
 
Route::get('getname/{type}', 'ProjectController@getname');
Route::resource('project', 'ProjectController');
//PROJECT MANAEMENT

Route::get('leave', 'lmabsenceController@disptype');
Route::get('sort/{type}', 'lmabsenceController@sorts');
Route::get('search', 'lmabsenceController@searchleave');
Route::get('searchemp', 'LMController@searchemp');
Route::get('leave/statistics', 'lmabsenceController@leavestat');
Route::post('/abreqemp', 'EmployeeController@submitrequest');
Route::get('/modifyRequest', 'EmployeeController@modifyRequest');
Route::resource('job', 'JobController');
Route::resource('available_jobs', 'AvailJobController');


//indaian
//Dashboard
Route::get('/dashboard', 'indians\ValidationController@checklogin');

//profile view page
Route::get('/viewprofile', 'indians\ValidationController@viewprofile');

/************SUCCESSOR MODULE START*****************/
//Successor Nomiee List
Route::get('/nominate-successor', 'indians\SuccessorController@index');

//Adding New successor to Database
Route::post('/successorcreate', 'indians\SuccessorController@insert');

//Approving New successor in Database how are nominated
Route::get('/successorapprove', 'indians\SuccessorController@approve');

//Updating New successor in Database by admin
Route::post('/successorupdate', 'indians\SuccessorController@update');

//List of nominated successors
Route::get('/successor-list', 'indians\SuccessorController@successor_list');

//Employee Hierarchy view
Route::get('/employee-hierarchy', 'indians\SuccessorController@emp_hierarchy');

//Ajax function to get the employee hierarchy
Route::get('/emp_hierarchy_json', 'indians\SuccessorController@emp_hierarchy_json');

//Add Vacancy Form - Admin
Route::get('/add-vacancy', 'indians\SuccessorController@add_vacancy_form');

//Save Vacancy Form
Route::post('/add-vacancy', 'indians\SuccessorController@add_vacancy');

//Edit Vacancy form filling DB data
Route::get('/edit-vacancy/{id}', array('uses' => 'indians\SuccessorController@fill_vacancy_form'));

//Updating data
Route::post('/update-vacancy', array('uses' => 'indians\SuccessorController@update_vacancy_form'));

//List of Vacancies
Route::get('/vacancy-list', 'indians\SuccessorController@vacancy_list');

//Delete Vacancy
Route::get('/delete_vacancy/{id}', 'indians\SuccessorController@delete_vacancy');

//Vacancy Status Change
Route::post('/vacancy_status_change', 'indians\SuccessorController@vacancy_status_change');


/************SUCCESSOR MODULE END*****************/

/************Training MODULE START*****************/
//Add Training Form
Route::get('/add-training', 'indians\TrainingController@add_training_form');

//Save Training Form
Route::post('/add-training', 'indians\TrainingController@add_training');

//Edit traning form filling DB data
Route::get('/edit-training/{id}', array('uses' => 'indians\TrainingController@fill_training_form'));

//Updating data
Route::post('/update-training', array('uses' => 'indians\TrainingController@update_training_form'));

//List of trainings
Route::get('/trainings-list', 'indians\TrainingController@trainings_list');

//Import Controller
Route::post('/import-training', array('uses' => 'indians\TrainingController@import_training'));

//List of trainings applied by employee in admin / people manager panels
Route::get('/trainings-applied', 'indians\TrainingController@trainings_applied');

//Delete training
Route::get('/delete_training/{id}', 'indians\TrainingController@delete_training');

//Training Status Change
Route::post('/training_status_change', 'indians\TrainingController@status_change');

//List of trainings for employee 
Route::get('/emp-trainings-list', 'indians\TrainingController@emp_trainings_list');

//List of applied training status for employee 
Route::get('/emp-trainings-status', 'indians\TrainingController@emp_trainings_status');

//Training schedules calendar for employee for a FY
Route::get('/training-schedule-calendar', 'indians\TrainingController@emp_trainings_calendar');

//List of training schedules for employee for a FY
Route::post('/emp-training-schedule', 'indians\TrainingController@emp_trainings_schedule');

//Applied Training Status Change
Route::post('/training_applied_status_change', 'indians\TrainingController@applied_status_change');

//Applying for a trainings by employee 
Route::post('/apply-training', 'indians\TrainingController@emp_apply_training');

//Add Training Material Form
Route::get('/add-training-material', 'indians\TrainingController@add_training_material_form');

//Save Training Form
Route::post('/add-training-material', 'indians\TrainingController@add_training_material');

//Edit traning form filling DB data
Route::get('/edit-training-material/{id}', array('uses' => 'indians\TrainingController@fill_training_material_form'));

//Updating data
Route::post('/update-training-material', array('uses' => 'indians\TrainingController@update_training_material_form'));

//List of trainings
Route::get('/training-material-list', 'indians\TrainingController@training_material_list');

//Delete training
Route::get('/delete_training_material/{id}', 'indians\TrainingController@delete_training_material');

//Training Status Change
Route::post('/training_material_status_change', 'indians\TrainingController@material_status_change');

//List of training registrations filtered by status 
Route::get('/enrollments-{status}', 'indians\TrainingController@enrollment_list');

/************Training MODULE END*****************/

/************SURVEY MODULE START*****************/

//Add Survey Form
Route::get('/add-survey', 'indians\SurveyController@add_survey_form');

//Save Survey Form
Route::post('/add-survey', 'indians\SurveyController@add_survey');

//Edit Survey form filling DB data
Route::get('/edit-survey/{id}', array('uses' => 'indians\SurveyController@fill_survey_form'));

//Updating Survey data
Route::post('/update-survey', array('uses' => 'indians\SurveyController@update_survey_form'));

//List of Surveys
Route::get('/survey-list', 'indians\SurveyController@survey_list');

//Delete Survey
Route::get('/delete_survey/{id}', 'indians\SurveyController@delete_survey');

//Survey Status Change
Route::post('/survey_status_change', 'indians\SurveyController@status_change');

//Sync Calendar
Route::post('/sync-calendar', 'indians\TrainingController@sync_calendar');

//Training survey to be filled by employee
Route::post('/training-survey-post', 'indians\SurveyController@emp_survey_post');

//Training survey list for employee
Route::get('/training-survey-list', 'indians\SurveyController@emp_survey_list');

//Filled Training survey by employee to add
Route::post('/training-survey-add', 'indians\SurveyController@emp_survey_add');

//filled surveys indiviual training list view for admin
Route::post('/filled-surveys', 'indians\SurveyController@filled_surveys');

//filled surveys indiviual training list view back from individual view page for admin
Route::get('/filled-surveys/{id}', 'indians\SurveyController@filled_surveys');

//filled surveys indiviual view for admin
Route::post('/filled-surveys-view', 'indians\SurveyController@filled_survey_view');

//filled surveys group view for admin
Route::get('/filled-surveys-list', 'indians\SurveyController@filled_surveys_list');

/************SURVEY MODULE END*****************/

/************Employee Health MODULE BY Doctor START*****************/
//Add Diagnosis Form
Route::get('/add-diagnosis', 'indians\HealthController@add_diagnosis_form');

//Save Diagnosis Form
Route::post('/add-diagnosis', 'indians\HealthController@add_diagnosis');

//Edit Diagnosis form filling DB data
Route::get('/edit-diagnosis/{id}', array('uses' => 'indians\HealthController@fill_diagnosis_form'));

//Updating data
Route::post('/update-diagnosis', array('uses' => 'indians\HealthController@update_diagnosis_form'));

//List of Diagnosis
Route::get('/diagnosis-details', 'indians\HealthController@diagnosis_list');

//Diagnosis Status Change
Route::post('/update-diagnosis-status', 'indians\HealthController@status_change');

//List of Diagnosis for all the employees
Route::get('/sick-leave-request', 'indians\HealthController@sick_leave_request');

/************Employee Health MODULE END*****************/

/************Employee Health MODULE BY Employee START*****************/
//Add Diagnosis Form
Route::get('/add-my-diagnosis', 'indians\HealthController@add_my_diagnosis_form');

//Save Diagnosis Form
Route::post('/add-my-diagnosis', 'indians\HealthController@add_my_diagnosis');

//Edit Diagnosis form filling DB data
Route::get('/edit-my-diagnosis/{id}', array('uses' => 'indians\HealthController@fill_my_diagnosis_form'));

//Updating data
Route::post('/update-my-diagnosis', array('uses' => 'indians\HealthController@update_my_diagnosis_form'));

//List of Diagnosis
Route::get('/my-diagnosis-details', 'indians\HealthController@my_diagnosis_list');

//Diagnosis Delete before approval
Route::get('/delete_my_diagnosis/{id}', 'indians\HealthController@delete_diagnosis');

//Generating medical certificate by doctor
Route::post('/issue_mc/{id}', 'indians\HealthController@create_mc');

/************Employee Health MODULE END*****************/

/*************Payroll Module Start******************/
//fill in the update weekend form
Route::get('/edit-weekend_days', 'indians\PayrollController@fill_weekend_form');

//update weekend form
Route::post('/update_weekend_days', 'indians\PayrollController@update_weekend_form');

//Holiday Calendar
Route::get('/holiday-calendar', 'indians\PayrollController@holiday_calendar');

//Add Holiday Form
Route::get('/add-holiday', 'indians\PayrollController@add_holiday_form');

//Save Holiday Form
Route::post('/add-holiday', 'indians\PayrollController@add_holiday');

//Edit Holiday form filling DB data
Route::get('/edit-holiday/{id}', array('uses' => 'indians\PayrollController@fill_holiday_form'));

//Updating data
Route::post('/update-holiday', array('uses' => 'indians\PayrollController@update_holiday_form'));

//List of holidays
Route::get('/holiday-list', 'indians\PayrollController@holiday_list');

//Delete Holiday
Route::get('/delete_holiday/{id}', 'indians\PayrollController@delete_holiday');

//Holiday Status Change
Route::post('/holiday_status_change', 'indians\PayrollController@holiday_status_change');

//List of Employees to add or edit basic pay
Route::get('/basicpay-list', 'indians\PayrollController@basicpay_list');

//Updating Payroll of employee by admin
Route::post('/basicpay-update', 'indians\PayrollController@basicpay_update');

//Add Allowance Form
Route::get('/add-allowance', 'indians\PayrollController@add_allowance_form');

//Save Allowance Form
Route::post('/add-allowance', 'indians\PayrollController@add_allowance');

//Edit Allowance form filling DB data
Route::get('/edit-allowance/{id}', array('uses' => 'indians\PayrollController@fill_allowance_form'));

//Updating Allowance
Route::post('/update-allowance', array('uses' => 'indians\PayrollController@update_allowance_form'));

//List of Allowances
Route::get('/allowance-list', 'indians\PayrollController@allowance_list');

//Delete Allowance
Route::get('/delete_allowance/{id}', 'indians\PayrollController@delete_allowance');

//Allowance Status Change
Route::post('/allowance_status_change', 'indians\PayrollController@allowance_status_change');

//List of Employees to add or edit Payroll
Route::get('/payroll-list', 'indians\PayrollController@payroll_list');

//Get payroll details to save in admin panel
Route::get('/get-payroll/{id}', array('uses' => 'indians\PayrollController@fill_payroll_form'));

//Get payroll details for employee to download
Route::get('/emp-payroll-list','indians\PayrollController@emp_payroll_list');

//Get payroll details from table to show in admin panel
Route::get('/get-saved-payroll/{id}', array('uses' => 'indians\PayrollController@fill_payroll_view'));

//Updating Payroll of employee by admin
Route::post('/payroll-update', 'indians\PayrollController@payroll_update');

//Generating payslip by admin
Route::post('/issue_ps/{id}', 'indians\PayrollController@create_ps');

//fill in the update CL form
Route::get('/edit-casual_leaves', 'indians\PayrollController@fill_casual_leaves');

//update CL form
Route::post('/update_casual_leaves', 'indians\PayrollController@update_casual_leaves');

//payslip list view of previous months for admin
Route::get('/view-previous-payslip', 'indians\PayrollController@view_previous_payslip');

//fill in the update Payslip logo / watermark form
Route::get('/edit-payslip-details', 'indians\PayrollController@fill_payslip_details');

//update CL form
Route::post('/update_payslip_details', 'indians\PayrollController@update_payslip_details');

//List of all the expenses added by an employee
Route::get('/my-expenses', 'indians\PayrollController@my_expenses_list');

//Add expense by an employee
Route::post('/add-expense', 'indians\PayrollController@add_expense');

//Delete own expense added by the employee
Route::get('/delete_expense/{id}', 'indians\PayrollController@delete_expense');

//Edit expense form filling DB data
Route::get('/edit-expense/{id}', array('uses' => 'indians\PayrollController@fill_expense_form'));

//Updating expense
Route::post('/update-expense', array('uses' => 'indians\PayrollController@update_expense'));

//List of all the expenses added by all the employees
Route::get('/employee-expenses', 'indians\PayrollController@employee_expenses_list');

//Expense Status Change
Route::post('/update-expense-status', 'indians\PayrollController@expense_status_change');



/*************Payroll Module End******************/

/***************Leave Management Module Start***********/

//Apply Leave Form
Route::get('/apply-leave', 'indians\LeaveController@apply_leave_form');

//Get the number of working days within the date range selected while applying for casual leave
Route::post('/getavailleave', 'indians\LeaveController@fnGetLeaves');

//Save Leave Form
Route::post('/apply-leave', 'indians\LeaveController@add_leave');

//List of leaves of logged in employee
Route::get('/my-leaves', 'indians\LeaveController@cl_list');

//Cancel Leave
Route::get('/cancel_leave/{id}', 'indians\LeaveController@cancel_leave');

//Holiday Status Change
Route::post('/leave_status_change', 'indians\LeaveController@leave_status_change');

//List of leaves applied by all employees
Route::get('/employee-leaves', 'indians\LeaveController@all_cl_list');

//Leave Status Change
Route::post('/update-leave-status', 'indians\LeaveController@status_change');
/***************Leave Management Module End***********/


/*************Attendance and Leave Module Start******************/

//Daily attendance individual view for admin and people manager
//Route::get('/view-daily-attendance/{id}', 'indians\PayrollController@view_daily_attendance');
//Route::get('/my-attendance', 'indians\PayrollController@view_daily_attendance');

//Daily attendance individual view of employee for admin and people manager
Route::post('/view-emp-daily-attendance', 'indians\PayrollController@view_emp_daily_attendance');

//Calendar function for Daily attendance individual view of employee for admin and people manager without employee id
Route::get('/view-emp-daily-attendance', 'indians\PayrollController@daily_attendance_list');

//
//Calendar function for Daily attendance individual view of employee for admin and people manager
Route::post('/view-emp-daily-attendance-calendar', 'indians\PayrollController@view_emp_daily_attendance_calendar');

//Daily attendance calendar view for employee
Route::get('/view-daily-attendance', 'indians\PayrollController@view_daily_attendance_calendar');

//calendar function for Daily attendance calendar view of employee
Route::post('/daily-attendance-calendar', 'indians\PayrollController@daily_attendance_calendar');

//Daily attendance list view for admin all employees
//Route::get('/daily-attendance-list', 'indians\PayrollController@daily_attendance_list');

//Daily attendance settings by admin
Route::get('/daily-attendance-settings', 'indians\PayrollController@daily_attendance_settings');

//Daily attendance settings individual for edit by admin
Route::get('/edit-daily-attendance-settings/{id}', 'indians\PayrollController@daily_attendance_settings_edit');

//Daily attendance settings new add by admin
Route::post('/add-daily-attendance-settings', 'indians\PayrollController@daily_attendance_settings_add');

//Daily attendance settings to save by admin
Route::post('/update-daily-attendance-settings', array('uses' => 'indians\PayrollController@daily_attendance_settings_update'));

//Daily attendance settings status change by admin
Route::post('/daily-attendance-settings-status-change', array('uses' => 'indians\PayrollController@daily_attendance_settings_status_change'));

//Daily attendance list view of employees for people manager under him  
Route::get('/day-att-emp-list', 'indians\PayrollController@day_att_emp_list');

//Delete Daily attendance settings
Route::get('/delete_daily_attendance_settings/{id}', 'indians\PayrollController@delete_daily_attendance_settings');


//Updating daily attendance by employee
//Route::get('/daily-attendance', 'indians\PayrollController@daily_attendance');

//Updating daily attendance in the database
Route::post('/daily-attendance-update', 'indians\PayrollController@daily_attendance_update');

//Updating daily attendance in the database by people manager of employee
Route::post('/daily-attendance-emp-update', 'indians\PayrollController@daily_attendance_emp_update');

//Saving daily attendance in the database by people manager of employee
Route::post('/daily-attendance-emp-save', 'indians\PayrollController@daily_attendance_emp_save');

/*************Attendance and Leave Module End******************/

//Route::get("/test_pdf", 'PdfController@generate_pdf');

Route::get("/test_leave_calc", 'indians\TestController@fnGetLeaves');

});
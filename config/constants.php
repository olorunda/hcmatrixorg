<?php

//Local
if($_SERVER['SERVER_NAME']=="localhost")
    $site_path = 'http://localhost/hcm/';
else
    $site_path = 'http://staging.vaiha.in/hcm/';

return [
    'roles' => [
        'Employee' => '1',
        'People_Manager' => '2',
        'Admin_User' => '3',
        'Factory_Employee' => '4',
        'Doctor' => '5'
        // etc
    ],
    'site_path' => ['absolute_path' => $site_path],

    'tables' => [
    'USER' => 'users',
    'SUCCESSOR_NOMINATION' => 'successor_nominations',
    'TRAINING' => 'trainings',
    'TRAINING_MATERIAL' => 'training_materials',
    'APPLY_TRAINING' => 'training_members',
    'SURVEY' => 'training_survey',
    'SURVEY_POST' => 'training_survey_post',
    'DIAGNOSIS' => 'health_diagnosis',
    'WEEKEND_DAYS' => 'weekend_days',
    'HOLIDAYS' => 'holiday_calendar',
    'BASICPAY' => 'basicpay_details',
    'PAYROLL' => 'payroll',
    'PAYROLL_DETAILS' => 'payroll_details',
    'ALLOWANCE_DEDUCTION' => 'allowance_deduction',
    'CL_DETAILS' => 'num_of_leave_details',
    'EMPLOYEE_LEAVES' => 'employee_casual_leaves',
    'DAILY_ATTENDANCE' => 'daily_attendance',
	'DAILY_ATTENDANCE_SETTINGS' => 'daily_attendance_settings',
    'SETTINGS' => 'settings',
    'EXPENSES' => 'emploee_expenses',
    'VACANCIES' => 'vacancies',
    'TAX_SLAB' => 'taxation_slab'
    ],
    
    'training_status'=>[ 
        'APPLIED' => 1,
        'APPROVED' => 2,
        'WAITING' => 3,
        'NOT_APPROVED' => 4
    ],
    'leave_status'=>[ 
        'PENDING' => 2,
        'APPROVED' => 1,
        'CANCELLED' => 0
    ],
    'leave_type'=>[ 
        'INTERNAL' => 1,
        'EXTERNAL' => 2
    ],
    'apply_leave_status'=>[ 
        'APPLIED' => 1,
        'APPROVED' => 2,
        'REJECTED' => 3,
        'CANCELLED' => 4
    ],
    'expense_status'=>[ 
        'APPLIED' => 1,
        'APPROVED' => 2,
        'REVISE' => 3,
        'REVISED' => 4,
        'REJECTED' => 5
    ]
];
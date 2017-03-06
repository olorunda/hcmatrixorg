<div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>

          <?php
            $training_array = array('add-training', 'trainings-list', 'add-training-material', 'training-material-list', 'add-survey', 'survey-list', 'trainings-applied', 'enrollments-all', 'emp-trainings-list', 'emp-trainings-status', 'training-schedule-calendar', 'training-survey-list', 'trainings-applied','filled-surveys-list','filled-surveys','filled-surveys-view');
            $succession_array = array('successor-list','employee-hierarchy','nominate-successor','successorapprove','vacancy-list');
            $health_array = array('diagnosis-details','my-diagnosis-details','sick-leave-request');
            $payroll_array = array('holiday-list','basicpay-list','allowance-list','payroll-list','emp-payroll-list','edit-weekend_days','edit-casual_leaves','edit-payslip-details','my-expenses','employee-expenses');
            $leave_array = array('my-leaves','daily-attendance','employee-leaves','view-daily-attendance','daily-attendance-list','daily-attendance-settings','day-att-emp-list');
          ?>
         <script>
  function url(url){

   window.location=url;
 }
</script> 
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('home')); ?>')">
    <i class="site-menu-icon  wb-home" aria-hidden="true"></i>
    <span class="site-menu-title">Home</span>

  </a>
</li>

<?php if(Auth::user()->role==3): ?>
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('hr/executiveview')); ?>')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Executive View</span>

  </a>
</li>
<?php endif; ?>
<?php if(Auth::user()->role>=1): ?>
	<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('outlookevent')); ?>')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Calender Events</span>

  </a>
</li>
<?php endif; ?>
	<?php if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1): ?>
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('view/attendancecalender')); ?>')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Attendance 360</span>

  </a>
</li>
	<?php endif; ?>
		<?php if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1 ): ?>
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('project/management')); ?>')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Project Management</span>

  </a>
</li>
	<?php endif; ?>
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('employee')); ?>/profile_<?php echo e(Auth::user()->id); ?>')">
    <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
    <span class="site-menu-title">Profile</span>

  </a>
  </li>
  
  <?php if(Auth::user()->role==2 || Auth::user()->role==3): ?>
	  
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('employee')); ?>/list')">
    <i class="site-menu-icon  wb-list" aria-hidden="true"></i>
    <span class="site-menu-title">Manage Employee</span>

  </a>
  </li>
  <?php endif; ?>
  
  <?php if(Auth::user()->role==3): ?>
   <li class="site-menu-item has-sub menuborder ">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Global Settings</span>
      <span class="site-menu-arrow"></span>
    </a>
 
    <ul class="site-menu-sub">
    
	   <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('hr')); ?>/settings">
          <span class="site-menu-title">All Settings</span>
        </a>
      </li> 
    </ul>

  </li>
  
  <!--  Role Management -->
 

    <?php endif; ?>
	

  <?php if(Auth::user()->role>0): ?>
	  
 <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Record Management</span>
      <span class="site-menu-arrow"></span>
    </a>  
  <ul class="site-menu-sub">
  <?php if(Auth::user()->role==2 || Auth::user()->role==3): ?>
      <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('view')); ?>/docadmin">
          <span class="site-menu-title">Record Management</span>
        </a>
      </li>
	<?php endif; ?>
	  <li class="site-menu-item">
        <a class="animsition-link"   <?php if(Auth::user()->role==1): ?> href="<?php echo e(url('view')); ?>/docadmin" <?php else: ?> href="<?php echo e(url('view')); ?>/mydocument" <?php endif; ?> >
          <span class="site-menu-title">My Documents</span>
        </a>
      </li>
  </ul>
  </li>
  <?php endif; ?>
  
  <?php if(Auth::user()->role!=0 ): ?>
  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Performance Management</span>
      <span class="site-menu-arrow"></span>
    </a>
	<?php endif; ?>
    <?php if(Auth::user()->role==1 ): ?>
    <ul class="site-menu-sub">
      <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('employee')); ?>/goalsview">
          <span class="site-menu-title">Manage Goals</span>
        </a>
      </li>
      <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('employee')); ?>/performance">
          <span class="site-menu-title">View Performance</span>
        </a>
      </li>
     <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('employee')); ?>/myquery">
          <span class="site-menu-title">View Query</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('review360')); ?>">
          <span class="site-menu-title">Employee Review 360</span>
        </a>
      </li>
    </ul>
    <?php endif; ?>
    <?php if(Auth::user()->role==2 ||Auth::user()->role==3): ?>
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder <?php echo e(active(['lm/objectives_a'])); ?>">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('<?php echo e(url('employee')); ?>/objective')">
          <span class="site-menu-title">Objective settings</span>
        </a>
      </li>
      <li class="site-menu-item  <?php echo e(active(['lm/objectives_c'])); ?>">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('<?php echo e(url('lm')); ?>/objectives_c')">
          <span class="site-menu-title">Performance Management</span>
        </a>
      </li>
    <li class="site-menu-item  <?php echo e(active(['lm/query'])); ?>">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('<?php echo e(url('lm')); ?>/query')">
          <span class="site-menu-title">Discipline Management</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="<?php echo e(url('review360')); ?>">
          <span class="site-menu-title">Employee Review 360</span>
        </a>
      </li>
    </ul>
    <?php endif; ?>
  </li>

  <!--absence Management-->
  
  <?php if(Auth::user()->role!=0 ): ?>


  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon fa fa-hotel" aria-hidden="true"></i>
      <span class="site-menu-title">Absence Management</span>
      <span class="site-menu-arrow"></span>
    </a>
	  <ul class="site-menu-sub">
 <li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('<?php echo e(url('employee')); ?>/absence')">

    <span class="site-menu-title">Leave Request</span>

  </a>
</li>
	
  <?php if(Auth::user()->role==2 || Auth::user()->role==3 ): ?>
      <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('<?php echo e(url('manage')); ?>/absence')">
          <span class="site-menu-title">View Request</span>
        </a>
      </li>   
    <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('<?php echo e(url('manage')); ?>/leavestat')">
          <span class="site-menu-title">Leave Statistics</span>
        </a>
      </li>
	    <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)" onclick="url('<?php echo e(url('hr')); ?>/attendance')">
      <span class="site-menu-title">Attendance Management</span>
   
    </a>
	</li>
	    <?php endif; ?>
		
	   </ul>
	
      </li> 
	 <?php endif; ?>



  
            <?php
            $training_array = array('add-training', 'trainings-list', 'add-training-material', 'training-material-list', 'add-survey', 'survey-list', 'trainings-applied', 'enrollments-all', 'emp-trainings-list', 'emp-trainings-status', 'training-schedule-calendar', 'training-survey-list', 'trainings-applied','filled-surveys-list','filled-surveys','filled-surveys-view');
            $succession_array = array('successor-list','employee-hierarchy','nominate-successor','successorapprove','vacancy-list');
            $health_array = array('diagnosis-details','my-diagnosis-details','sick-leave-request');
            $payroll_array = array('holiday-list','basicpay-list','allowance-list','payroll-list','emp-payroll-list','edit-weekend_days','edit-casual_leaves','edit-payslip-details','my-expenses','employee-expenses');
            $leave_array = array('my-leaves','daily-attendance','employee-leaves','view-daily-attendance','daily-attendance-list','daily-attendance-settings','day-att-emp-list');
          ?>
         

          
             <li class="site-menu-item has-sub <?php echo e(in_array(Request::path(), $training_array) ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Training and Development</span>
                <span class="site-menu-arrow"></span>
              </a>
              

              <!--If admin User-->
              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
          
                <!--<li class="site-menu-item <?php echo e((Request::is('add-training') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/add-training')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training</span>                    
                  </a>
                </li>-->
				
				      <ul class="site-menu-sub">
                
                <li class="site-menu-item <?php echo e((Request::is('trainings-list') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/trainings-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Trainings</span>                    
                  </a>
				  </li>
                <!--<li class="site-menu-item <?php echo e((Request::is('add-training-material') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/add-training-material')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Materials</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item <?php echo e((Request::is('training-material-list') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/training-material-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Materials</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item <?php echo e((Request::is('add-survey') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/add-survey')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Survey</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder <?php echo e(((Request::is('survey-list') || Request::is('add-survey')) ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/survey-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>                
                <?php $survey_subarray = array('filled-surveys-list','filled-surveys','filled-surveys-view'); ?>
                <li class="site-menu-item menuborder <?php echo e(in_array(Request::path(), $survey_subarray) ? 'active' : ''); ?>">
                  <a href="<?php echo e(url('/filled-surveys-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Filled Surveys</span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder <?php echo e((Request::is('enrollments-all') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/enrollments-all')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
				
				</li>
              </ul>    
            <?php endif; ?>

            <!--If Employee-->
            <?php if(Auth::user()->role==Config::get('constants.roles.Employee')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item menuborder <?php echo e((Request::is('emp-trainings-list') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/emp-trainings-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Select Elective Training </span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder <?php echo e((Request::is('emp-trainings-status') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/emp-trainings-status')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Status </span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder <?php echo e((Request::is('training-schedule-calendar') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/training-schedule-calendar')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Schedules FY</span>                    
                  </a>
                </li> 
                <!--<li class="site-menu-item has-sub">
                  <a href="#">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Save Training to Outlook Calendar</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder <?php echo e((Request::is('training-survey-list') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/training-survey-list')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>
				</li>
              </ul>   
            <?php endif; ?>
            <!--If People_Manager-->
            <?php if(Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <ul class="site-menu-sub">
                <!--<li class="site-menu-item <?php echo e((Request::is('trainings-applied') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/trainings-applied')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Applied</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder <?php echo e((Request::is('enrollments-all') ? ' active' : '')); ?>">
                  <a href="<?php echo e(url('/enrollments-all')); ?>">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
              </ul>    
            <?php endif; ?>
            </li>
          <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
            <li class="site-menu-item has-sub <?php echo e(in_array(Request::path(), $succession_array) ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Succession Planning</span>
                <span class="site-menu-arrow"></span>
              </a>
              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('employee-hierarchy') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/employee-hierarchy')); ?>">
                    <span class="site-menu-title">Employees Hirerachy</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('successor-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/successor-list')); ?>">
                    <span class="site-menu-title">Successors List</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('vacancy-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/vacancy-list')); ?>">
                    <span class="site-menu-title">Vacancy List</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
              <?php if(Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('successor-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/successor-list')); ?>">
                    <span class="site-menu-title">Nominated Successors</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('nominate-successor') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/nominate-successor')); ?>">
                    <span class="site-menu-title">Select Successors<!-- (Internal -> select from list, External -> New entry)--></span>
                  </a>
                </li>
                <!--
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Readyness of Candidate</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Training Requirement for Candidate</span>
                  </a>
                </li>-->
              </ul>
              <?php endif; ?>
              </li>
              <?php endif; ?>
             <li class="site-menu-item has-sub <?php echo e(in_array(Request::path(), $health_array) ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Employee Health</span>
                <span class="site-menu-arrow"></span>
              </a>
              <?php if(Auth::user()->role==Config::get('constants.roles.Doctor')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('diagnosis-details') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/diagnosis-details')); ?>">
                    <span class="site-menu-title">Diagnosis Details</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?> 
              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('sick-leave-request') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/sick-leave-request')); ?>">
                    <span class="site-menu-title">Sick Leave Requests</span>
                  </a>
                </li>
                <!--<li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Medical Trends</span>
                  </a>
                </li>-->               
              </ul>
              <?php endif; ?>              
              <?php if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('my-diagnosis-details') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/my-diagnosis-details')); ?>">
                    <span class="site-menu-title">Diagnosis Details</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
              </li>
              <li class="site-menu-item has-sub <?php echo e(in_array(Request::path(), $payroll_array) ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Payroll</span>
                <span class="site-menu-arrow"></span>
              </a>
              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('holiday-calendar') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/holiday-calendar')); ?>">
                    <span class="site-menu-title">Holiday Calendar</span>
                  </a>
                </li>
              </ul>-->
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('edit-weekend_days') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/edit-weekend_days')); ?>">
                    <span class="site-menu-title">Default Weekend Days</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('edit-casual_leaves') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/edit-casual_leaves')); ?>">
                    <span class="site-menu-title">No. of Casual Leaves Per Month</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('edit-payslip-details') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/edit-payslip-details')); ?>">
                    <span class="site-menu-title">Payslip logo & watermark</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('holiday-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/holiday-list')); ?>">
                    <span class="site-menu-title">Holiday List</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('basicpay-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/basicpay-list')); ?>">
                    <span class="site-menu-title">Basic Pay</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('allowance-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/allowance-list')); ?>">
                    <span class="site-menu-title">Salary components</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('employee-expenses') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/employee-expenses')); ?>">
                    <span class="site-menu-title">All Employee Expenses</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('payroll-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/payroll-list')); ?>">
                    <span class="site-menu-title">Payroll Details</span>
                  </a>
                </li>
              </ul>  
              <?php endif; ?>    
              <?php if(Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('employee-expenses') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/employee-expenses')); ?>">
                    <span class="site-menu-title">All Employee Expenses</span>
                  </a>
                </li>
              </ul>  
              <?php endif; ?>    
              <?php if(Auth::user()->role!=Config::get('constants.roles.Admin_User')): ?>
              
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('emp-payroll-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/emp-payroll-list')); ?>">
                    <span class="site-menu-title">Payroll Details</span>
                  </a>
                </li>
              </ul> 
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('my-expenses') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/my-expenses')); ?>">
                    <span class="site-menu-title">My Expenses</span>
                  </a>
                </li>
              </ul>
              
              <?php endif; ?>        
            </li> 
            <li class="site-menu-item has-sub <?php echo e(in_array(Request::path(), $leave_array) ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Leave and Attendance</span>
                <span class="site-menu-arrow"></span>
              </a>
              <?php if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee') || Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('my-leaves') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/my-leaves')); ?>">
                    <span class="site-menu-title">My Leaves</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e(((Request::is('daily-attendance') || Request::is('view-daily-attendance')) ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/daily-attendance')); ?>">
                    <span class="site-menu-title">Daily Attendance</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
			  <?php if(Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('my-leaves') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/my-leaves')); ?>">
                    <span class="site-menu-title">My Leaves</span>
                  </a>
                </li>
              </ul>-->
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('day-att-emp-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/day-att-emp-list')); ?>">
                    <span class="site-menu-title">Employee Daily Attendance</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
			  <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('employee-leaves') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/employee-leaves')); ?>">
                    <span class="site-menu-title">All Employee Leaves</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('daily-attendance-list') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/daily-attendance-list')); ?>">
                    <span class="site-menu-title">All Employee Attendances</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e((Request::is('daily-attendance-settings') ? ' active' : '')); ?>">
                  <a class="animsition-link" href="<?php echo e(url('/daily-attendance-settings')); ?>">
                    <span class="site-menu-title">Daily Attendance Settings</span>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
            </li>  
			
    
	  

 
   </div>
    </div>
   
  </div>
   
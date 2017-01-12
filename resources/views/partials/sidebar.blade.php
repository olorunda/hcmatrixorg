<script>
  function url(url){

   window.location=url;
 }
</script> 
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('home')}}')">
    <i class="site-menu-icon  wb-home" aria-hidden="true"></i>
    <span class="site-menu-title">Home</span>

  </a>
</li>

@if(Auth::user()->role==3)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('hr/executiveview')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Executive View</span>

  </a>
</li>
@endif

	@if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('view/attendancecalender')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Attendance 360</span>

  </a>
</li>
	@endif
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/profile')">
    <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
    <span class="site-menu-title">Profile</span>

  </a>
  </li>
  
  @if(Auth::user()->role==2 || Auth::user()->role==3)
	  
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/list')">
    <i class="site-menu-icon  wb-list" aria-hidden="true"></i>
    <span class="site-menu-title">Manage Employee</span>

  </a>
  </li>
  @endif
  
  @if(Auth::user()->role==3)
   <li class="site-menu-item has-sub menuborder ">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Global Settings</span>
      <span class="site-menu-arrow"></span>
    </a>
 
    <ul class="site-menu-sub">
    
	   <li class="site-menu-item">
        <a class="animsition-link" href="{{url('hr')}}/settings">
          <span class="site-menu-title">All Settings</span>
        </a>
      </li> 
    </ul>

  </li>
  
  <!--  Role Management -->
 

    @endif
	

  @if(Auth::user()->role>0)
	  
 <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Record Management</span>
      <span class="site-menu-arrow"></span>
    </a>  
  <ul class="site-menu-sub">
  @if(Auth::user()->role==2 || Auth::user()->role==3)
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('view')}}/docadmin">
          <span class="site-menu-title">Record Management</span>
        </a>
      </li>
	@endif
	  <li class="site-menu-item">
        <a class="animsition-link"   @if(Auth::user()->role==1) href="{{url('view')}}/docadmin" @else href="{{url('view')}}/mydocument" @endif >
          <span class="site-menu-title">My Documents</span>
        </a>
      </li>
  </ul>
  </li>
  @endif
  
  @if(Auth::user()->role!=0 )
  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Performance Management</span>
      <span class="site-menu-arrow"></span>
    </a>
	@endif
    @if(Auth::user()->role==1 )
    <ul class="site-menu-sub">
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/goalsview">
          <span class="site-menu-title">Manage Goals</span>
        </a>
      </li>
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/performance">
          <span class="site-menu-title">View Performance</span>
        </a>
      </li>
     <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/myquery">
          <span class="site-menu-title">View Query</span>
        </a>
      </li>
    </ul>
    @endif
    @if(Auth::user()->role==2 ||Auth::user()->role==3)
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder {{active(['lm/objectives_a'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('employee')}}/objective')">
          <span class="site-menu-title">Objective settings</span>
        </a>
      </li>
      <li class="site-menu-item  {{active(['lm/objectives_c'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('lm')}}/objectives_c')">
          <span class="site-menu-title">Performance Management</span>
        </a>
      </li>
    <li class="site-menu-item  {{active(['lm/query'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('lm')}}/query')">
          <span class="site-menu-title">Discipline Management</span>
        </a>
      </li>
    </ul>
    @endif
  </li>

  <!--absence Management-->
  
  @if(Auth::user()->role!=0 )


  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon fa fa-hotel" aria-hidden="true"></i>
      <span class="site-menu-title">Absence Management</span>
      <span class="site-menu-arrow"></span>
    </a>
      



  
    <ul class="site-menu-sub">
 <li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/absence')">

    <span class="site-menu-title">Leave Request</span>

  </a>
</li>
	@endif
  @if(Auth::user()->role==2 || Auth::user()->role==3 )
      <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('manage')}}/absence')">
          <span class="site-menu-title">View Request</span>
        </a>
      </li>   
    <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('manage')}}/leavestat')">
          <span class="site-menu-title">Leave Statistics</span>
        </a>
      </li>
	    <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)" onclick="url('{{url('hr')}}/attendance')">
      <span class="site-menu-title">Attendance Management</span>
   
    </a>
	</li>
	    @endif
	
   

    </ul>
  
	
  </li>
  @if(Auth::user()->role==3 || Auth::user()->role==2)
	 
  
  <!-- <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Payroll</span>
   
    </a>
	</li>-->
  
  @endif
  

  <!--JUST ADDED -->
  @if(Auth::user()->role==3)
	  
  
             <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Training and Development</span>
                <span class="site-menu-arrow"></span>
              </a>
              

              <!--If admin User-->
                            <ul class="site-menu-sub">
                <!--<li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/add-training">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/trainings-list">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Trainings</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/add-training-material">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Materials</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/training-material-list">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Materials</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/add-survey">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Survey</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/survey-list">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/trainings-applied">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Applied</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/enrollments-all">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
              </ul>    
            <!-- HFHFHE -->
  </li>
                      <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Succession Planning</span>
                <span class="site-menu-arrow"></span>
              </a>
                            <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/employee-hierarchy">
                    <span class="site-menu-title">Employees Hirerachy</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/successor-list">
                    <span class="site-menu-title">Successors List</span>
                  </a>
                </li>
              </ul>
                                          </li>
										  
										   <!--JUST ADDED -->
  
                           <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Employee Health</span>
                <span class="site-menu-arrow"></span>
              </a>
                                          <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Sick Leave Request Report</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Medical Trends</span>
                  </a>
                </li>               
              </ul>
                            
                            </li>
              <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Payroll</span>
                <span class="site-menu-arrow"></span>
              </a>
                            <!--<ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/holiday-calendar">
                    <span class="site-menu-title">Holiday Calendar</span>
                  </a>
                </li>
              </ul>-->
              <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/holiday-list">
                    <span class="site-menu-title">Holiday List</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item  active">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/basicpay-list">
                    <span class="site-menu-title">Basic Pay</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/allowance-list">
                    <span class="site-menu-title">Allowances / Deductions</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/payroll-list">
                    <span class="site-menu-title">Payroll Details</span>
                  </a>
                </li>
              </ul>
              
                            <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a class="animsition-link" href="http://staging.vaiha.in/hcm/my-leaves">
                    <span class="site-menu-title">My Leaves</span>
                  </a>
                </li>
              </ul>
            </li>                
        		
  @endif
  @if(Auth::user()->role==3)
	  
<!-- TALENT AQUISITION -->
   <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
      <span class="site-menu-title">Talent Management</span>
      <span class="site-menu-arrow"></span>
    </a>

    
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder {{active(['lm/objectives_a'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('manage')}}/positions')">
          <span class="site-menu-title">Manage/Add Position</span>
        </a>
      </li>
	  @if(Auth::user()->role==3)
	  <li class="site-menu-item menuborder {{active(['employee/uploadapptitude'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('employee')}}/uploadapptitude')">
          <span class="site-menu-title">Upload Apptitude Test</span>
        </a>
      </li>
	  @endif
       </ul>
   
  </li>

  @endif
  <!-- JOBS -->
  @if(Auth::user()->role==2 || Auth::user()->role==1)
	

             <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Training and Development</span>
                <span class="site-menu-arrow"></span>
              </a>
	   <ul class="site-menu-sub">
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/emp-trainings-list">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Select Elective Training </span>                    
                  </a>
                </li>
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/emp-trainings-status">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Status </span>                    
                  </a>
                </li>
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/training-schedule-calendar">
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
                <li class="site-menu-item ">
                  <a href="http://staging.vaiha.in/hcm/training-survey-list">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>
              </ul>   
                        <!--If People_Manager-->
                        </li>
					

  @endif 
  @if(Auth::user()->role==3)
	  @else
     <li class="site-menu-item has-sub ">
              <a href="javascript:void(0)">
                 <i class="site-menu-icon  fa fa-suitcase" aria-hidden="true"></i>
                <span class="site-menu-title">Jobs</span>
                <span class="site-menu-arrow"></span>
              </a>
			  <ul class="site-menu-sub">
  <li class="site-menu-item" >
  <a href="javascript:void(0)" onclick="url('{{url('available_jobs')}}/joblist')">
     <span class="site-menu-title">Jobs</span>
  </a>
</li>
<li class="site-menu-item " >
  <a href="javascript:void(0)" onclick="url('{{url('available_jobs')}}/applied')">
     <span class="site-menu-title">Jobs Applied For</span>
  </a>
</li>
</ul>
  </li>
  @endif
  @if(Auth::user()->role==1 || Auth::user()->role==2)


<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" >
    <i class="site-menu-icon  fa fa-suitcase" aria-hidden="true"></i>
    <span class="site-menu-title">Expense Request</span>
  </a>
</li>
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" >
    <i class="site-menu-icon  fa fa-suitcase" aria-hidden="true"></i>
    <span class="site-menu-title">View PaySlip</span>
  </a>
</li>
@endif
  </ul>
</li>

</li>
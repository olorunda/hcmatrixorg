@include('layouts.header', ['page_title' => 'Daily Attendance'])

  <!-- Page -->
  <div class="page">
      <div class="page-header">
      <h1 class="page-title">Daily Attendance</h1>
     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">     
            @if (session('success'))
                <div class="flash-message">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                </div>
            @endif
            @if (session('error'))
                <div class="flash-message">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                </div>
            @endif 
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
				<div class="text-xs-right">
                        <?php /*<button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="window.location = 'view-daily-attendance';">View Daily attendance</button>*/ ?>
						<button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnSubmit({{ Auth::id() }})">View Daily attendance</button>
                        <form id="view_form" action="{{ url('/view-daily-attendance')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "emp_id" value="">
                  </form>  
                    </div>
                    <div class="clearfix"></div><br/>
                  <table class="table table-bordered table-striped">
                      <tbody> 
                           <tr>
                                <th>Employee #</th> 
                                <td>{{ $employee->emp_num }}</td>
                            </tr>                            
                            <tr>
                                <th>Name</th> 
                                <td>{{ $employee->name }}</td>
                            </tr> 
                            <tr>
                                <th>Date</th> 
                                <td>{{ date("M d, Y, g:i a") }}</td>
                            </tr> 
                      </tbody> 
                      <tfoot>
                          <tr>
                              <td colspan="2">
                                  <form id="basicpay_form" action="daily-attendance-update" method="post">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                      <input type="hidden" name="num" id = "employee_num" value="{{ $employee->emp_num }}">
                                  
                                  @if(!empty($condition))
                                      @if($condition=="weekend")
                                        Its a Weekend
                                      @elseif($condition=="holiday")
                                        Its a Holiday
                                      @elseif($condition=="leaveapproved")
                                        Its a Leave approved day
                                      @elseif($condition=="fullrecordexists")                                      
                                        Already Punching done
                                      @elseif($condition=="halfrecordexists")
                                          @foreach ($daily_records as $daily_record)  
                                                <input type="hidden" name="record_id" value="{{ $daily_record->id }}">
                                                <input type="submit" class="btn btn-primary" value="Out-Time" />
                                          @endforeach
                                      @endif                                       
                                  @else
                                      <input type="submit" class="btn btn-primary" value="In-Time" />
                                  @endif  
                                  </form>
                              </td>
                          </tr>                      
                      </tfoot>
                  </table>    
                        
                </div>
              </div>          
              <!-- End Widget Timeline -->
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <!-- End Page -->
  
  
  
  <!-- Footer -->
@include('layouts.footer')
<script type="text/javascript">     
   function fnSubmit(arg)
    {
      $("#emp_id").val(arg);
      $("#view_form").submit();
    }

  </script>
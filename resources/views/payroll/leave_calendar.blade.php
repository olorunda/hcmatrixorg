@include('layouts.header', ['page_title' => 'Leave Calendar FY'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Leave Calendar FY</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
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
      @if (count($errors)>0)
                <div class="flash-message">
                <div class="alert alert-danger">
                    {{ $errors->first() }} 
                </div>
                </div>
            @endif 
            <div class="flash-message">
                <div class="alert alert-success" id="status_div" style="display:none;">
                    Holiday status updated successfully!
                </div>
                </div> 
                <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddHoliday()">Add Holiday</button><!--&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnImport()">Import Holidays</button><br/><a href="public/sample_files/holiday_import_format.xlsx" target="_blank">Sample Excel File</a>-->

                  <div class="calendar-container">
                    <div id="holiday_calendar"></div>            
                    <input type="hidden" name="_token" id="calendar_token" value="<?php echo csrf_token(); ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
                </div>
            </div>
      </div>
    </div>
  </div>
  
  <!-- modal start -->
    <div id='modal-import-holidays' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('import-holiday') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Import Holidays</h4>
          </div>
          <div class="modal-body">
            <form id="import-holidays-form" action="" method="post">
              <p><label>Upload CSV File: </label> &nbsp;<input type="file" name="file_import" id="file_import" > </p>
              <p class="text-right"><input type="submit" class="btn btn-primary" value="Submit" /></p>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  <!-- modal end -->

  <!--- Add holiday modal start -->
  <div class="modal fade in" id="holiday-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_holiday_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="holiday_title">Add Holiday</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <label class="example-title">Multiple Days Holiday</label>
                <input type="checkbox" id="multiple_days" name="multiple_days" value="1" {{ ((old("multiple_days")!='' && old("multiple_days") ==  1) || (isset($holiday_details) && $holiday_details->multiple_days!='' && $holiday_details->multiple_days ==  1)) ? "checked=checked":"" }}>              
              </div>
              <div id="multiple_days_err"></div>
              <div class="form-group" id="single_day_div">
                <label class="example-title">Day</label>
                <div class="example">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control" id="single_day" name="single_day" placeholder="Date" value="{{ old('single_day')!='' ? old('single_day') : ((isset($holiday_details) && $holiday_details->single_day!='') ? date('M d, Y', strtotime($holiday_details->single_day)) : '') }}" data-plugin="datepicker">
                  </div>
                </div>  
              </div> 
              <div id="single_day_err"></div>             
              <div class="form-group" id="multiple_days_div" style="display:none;">
                <label class="example-title">Holiday Period</label>               
                <div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="from_date" id="from_date" value="{{ old('from_date')!='' ? old('from_date') : ((isset($holiday_details) && $holiday_details->from_date!='') ? date('M d, Y', strtotime($holiday_details->from_date)) : '') }}" />                      
                    </div>                    
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="to_date" id="to_date" value="{{ old('to_date')!='' ? old('to_date') : ((isset($holiday_details) && $holiday_details->to_date!='') ? date('M d, Y', strtotime($holiday_details->to_date)) : '') }}" />                      
                    </div>                   
                  </div>                   
                </div>
                <div id="from_date_err" class="col-xs-6 no-padding"></div>    
                <div id="to_date_err" class="col-xs-6 no-right-padding"></div>                   
              </div>
              <div class="clearfix"></div>            
              <div class="form-group">
                <label class="example-title">Reason</label>
                <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason" value="{{ old('reason')!='' ? old('reason') : ((isset($holiday_details) && $holiday_details->reason!='') ? $holiday_details->reason : '') }}">               
              </div>
              <div id="reason_err"></div>    
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left col-xs-6" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()">
                <input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'holiday-calendar';">
                </div>
               
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add holiday modal end -->
  
  <!-- Footer -->
  @include('layouts.footer')
  <script src="{{ URL::asset('js/HolidayCalendar.js') }}"></script>
  <script type="text/javascript">

  $('#multiple_days').change(function() {
    $("#multiple_days_div").css("display","none");
    $("#single_day_div").css("display","block");
    $("#from_date_err").html('');
    $("#to_date_err").html('');

    if($(this).is(":checked")) {
      $("#multiple_days_div").css("display","block");
      $("#single_day_div").css("display","none");
      $("#single_day_err").html('');
    }
    });


  $("#multiple_days").click(function(){ 
        var element = $(this).find('option:selected'); 
        fnClient(element.val());
        getSpecicalRequest(element.val());
        getShippingDetails(element.val());
        getPetId();
       
         
    }); 

  //Add holiday
  function fnAddHoliday()
  {
    $("#holiday_title").html("Add Holiday");
    $(".alert").remove();
    $("#holiday_btn").val("Save");
    $("#add_holiday_form")[0].reset();
    $("#holiday-modal").modal("show");
  }

  //Edit holiday
  function fnEditHoliday(arg)
  {
    $("#holiday_title").html("Edit Holiday");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-holiday/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var holiday_details = response.holiday_details;
          //filling the old values
          $("#job_role").val(holiday_details.job_role);
          $("#single_day").val(holiday_details.single_day);
          $("#from_date").val(holiday_details.from_date);
          $("#to_date").val(holiday_details.to_date);
          $("#reason").val(holiday_details.reason);
          $("#id").val(holiday_details.id);
          $("#holiday_btn").val("Update");
          $("#holiday-modal").modal("show");
          
        }     
      });
  }

  function fnHoliday()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-holiday';
      else
          url = 'add-holiday';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_holiday_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fnHoliday()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()">');
          if(response.Success==1)
          {
            $("#add_holiday_form")[0].reset();
            window.location.href = "holiday-calendar";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fnHoliday()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()">');
        var errors = data.responseJSON;
        if(errors.multiple_days)
        {
          $("#multiple_days_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.multiple_days+'</strong></div></div>');
        }
        if(errors.single_day)
        {
          $("#single_day_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.single_day+'</strong></div></div>');
        }
        if(errors.from_date)
        {
          $("#from_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.from_date+'</strong></div></div>');
        }
        if(errors.to_date)
        {
          $("#to_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.to_date+'</strong></div></div>');
        }
        if(errors.reason)
        {
          $("#reason_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.reason+'</strong></div></div>');
        }
        
        
      }   
      });
    }

  </script>

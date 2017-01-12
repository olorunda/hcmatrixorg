<?php $__env->startSection('content'); ?>
<?php  $jobdetail = app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id); ?>
<?php $leaves     = app('App\Http\Controllers\EmployeeController')->getLeaveDue(Auth::user()->role); 

?>
<?php $requests   = app('App\Http\Controllers\EmployeeController')->getLeaveRequest(Auth::user()->id); ?>
<?php $yearlyDue  = app('App\Http\Controllers\EmployeeController')->totalLeaveFiscal(Auth::user()->role);


?>
<?php 
function status($id)
{
  $retVal;
  switch($id)
  {
    case 0:
	$retVal = "<span class='tag tag-warning font-weight-100'>Pending</span>";
    break;
    case 1:
	$retVal = "<span class='tag tag-success font-weight-100'>Approved</span>";
    break;
    case 2:
    $retVal = "<span class='tag tag-danger font-weight-100'>Rejected</span>";
    break;
  }
  return $retVal;
}
?>
<script>
  function url(url){

   window.location=url;
 }
</script>
<style type="text/css">
.borderless tbody tr td,
.borderless tbody tr th,
.borderless thead tr th,
.borderless thead tr td,
.borderless tfoot tr th,
.borderless tfoot tr td {
    border: none;
}
  /*.borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
  }*/
</style>
<div class="row" data-plugin="matchHeight" data-by-row="true">
  <!-- First Row -->
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-warning" data-toggle="modal" data-target="#holidays">
          <i class="fa fa-lg fa-plane"></i>
        </button>
        <span class="m-l-15 font-weight-400">HOLIDAYS</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-up font-size-20"></i>
          <span class="font-size-40 font-weight-100"><?php echo e(count($holidays)); ?> </span>
          <p class="blue-grey-400 font-weight-100 m-0">Recognised Public Holidays</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-danger">
          <i class="wb wb-home"></i>
        </button>
        <span class="m-l-15 font-weight-400">LEAVE BANK</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-down font-size-20">
          </i>
          <span class="font-size-40 font-weight-100">
            <?php if(count($yearlyDue) > 0): ?>
            <?php echo e($yearlyDue->day_num); ?> Days
            <?php else: ?>
            0
            <?php endif; ?>
          </span>
          <p class="blue-grey-400 font-weight-100 m-0">Annual Leave Due</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-success" data-toggle="modal" data-target="#requests">
          <i class="wb-calendar"></i>
        </button>
        <span class="m-l-15 font-weight-400">REQUESTS</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-danger icon wb-triangle-up font-size-20">
          </i>
          <span class="font-size-40 font-weight-100"><?php echo e(count($requests)); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">
            <?php $totalpend = 0; ?>
            <?php if(count($requests) > 0): ?>
            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($request->status==1): ?>
            <?php $totalpend+=1; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
            <?php echo e($totalpend); ?> Pending Approvals
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-primary" data-toggle="modal" data-target="#categories">
          <i class="wb-copy"></i>
        </button>
        <span class="m-l-15 font-weight-400">CATEGORIES</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-up font-size-20">
          </i>
          <span class="font-size-40 font-weight-100"><?php echo e(count($leaves)); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">Absence Categories</p>
        </div>
      </div>
    </div>
  </div>
  <!-- End First Row -->
  <!-- second Row -->
  <div class="col-ms-12 col-xs-12 col-md-6">
    <div class="card card-shadow">
      <div class="card-header card-header-transparent p-y-20">
        <div>
          <input type="hidden" name="_request_token" id="requesttoken" value="<?php echo e(csrf_token()); ?>">
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" autocomplete="off" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" autocomplete="off" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
            </div>
          </div>
          <div class="form-group">
            <div class="radio-custom radio-default radio-inline">
              <input type="radio" id="withpay" name="paystatus" checked value="1">
              <label for="withpay">With Pay</label>
            </div>
            <div class="radio-custom radio-default radio-inline">
              <input type="radio" id="withoutpay" name="paystatus" value="0">
              <label for="withoutpay">Without Pay</label>
            </div>
          </div>
          <div class="form-group">
            <select class="form-control" id="priority" name="priority" data-plugin="select2" data-placeholder="Select Priority" data-allow-clear="true">
              <option value="">-Select Priority-</option>
              <option value="0">Normal</option>
              <option value="1">Medium</option>
              <option value="2">High</option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" id="abtype" data-plugin="select2" data-placeholder="Select Absence Type" data-allow-clear="true">
              <option value="">-Select Absence Type-</option>
              <?php if(count($leaves) > 0): ?>
              <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <option value="<?php echo e($leave->id); ?>"><?php echo e($leave->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-group">
            <textarea class="form-control" id="reason" name="reason" style="height: 100px;resize: none;" placeholder="Briefly State Reason" required="required"></textarea>
          </div>
          <div class="form-group">
            <div class="radio-custom radio-default radio-inline">
              <input type="radio" id="yesupload" name="uploadsupport" value="1" onclick="dropZone(1);">
              <label for="yesupload">Upload Support Document</label>
            </div>
            <div class="radio-custom radio-default radio-inline">
              <input type="radio" id="noupload" name="uploadsupport" value="0"  onclick="dropZone(0);">
              <label for="noupload">No</label>
            </div>
          </div>
          <div class="form-group">
            <!--<input type="file" id="input-file-disable-remove" data-plugin="dropify" data-disable-remove="true" data-max-file-size="0.3125M" data-show-errors="true" data-errors-position="outside" data-allowed-file-extensions="png jpeg jpg docx doc pdf">-->
            <div class="dropzone" id="my-dropzone" style="display: none;">

            </div>
            <script>
              function dropZone(status)
              {
                if(status == 1)
                {
                  console.log("Upload Document");
                  $(".dropzone").slideDown("slow");
                }
                else
                {
                  console.log("Do not upload Document");
                  $(".dropzone").slideUp("slow");
                  $("#submitrequest").click(function(){
                    var token     = $("#requesttoken").val();
                    var startdate = $("#start_date").val();
                    var enddate   = $("#end_date").val();
                    var pay       = $('input[name=paystatus]:checked').val();
                    var priority  = $("#priority").val();
                    var type      = $("#abtype").val();
                    var reason    = $("#reason").val();
                    var total     = $("#totalreq").val();

                    if(!startdate || startdate == '')
                    {
                      $("#starterror").text("Please select a start date.").fadeIn("slow");
                      return false;
                    }
                    else
                    {
                      $("#starterror").text("Please select a start date.").fadeOut("slow"); 
                    }
                    if(!enddate || enddate == '')
                    {
                      $("#enderror").text("Please select a valid end date").fadeIn("slow");
                      return false;
                    }
                    else
                    {
                      $("#enderror").text("Please select a valid end date").fadeOut("slow");  
                    }
                    if(!priority || priority == '')
                    {
                      $("#priorityerror").text("Please select a valid priority").fadeIn("slow");
                      return false;
                    }
                    else
                    {
                      $("#priorityerror").text("Please select a valid priority").fadeOut("slow");
                    }
                    if(!type || type == '')
                    {
                      $("#aberror").text("Please select a valid absence type").fadeIn("slow");
                      return false;
                    }
                    else
                    {
                      $("#aberror").text("Please select a valid absence type").fadeOut("slow");
                    }
                    if(!reason || reason == '')
                    {
                      $("#reasonerror").text("Enter a valid reason").fadeIn("slow");
                      return false;
                    }
                    else
                    {
                      $("#reasonerror").text("Enter a valid reason").fadeOut("slow"); 
                    }

                    var formData = {'_token':token, 'startdate':startdate, 'enddate':enddate, 'pay':pay, 'priority':priority, 'type':type, 'reason':reason, 'total':total};

                    $.post('/abreqemp', formData, function(data,xhr,status){
                      console.log(data);
                      if(data == 0)
                      {
                        $("#exampleCloseButton").click();
                        $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>You have exhausted your leave credit. You can only apply for a leave without pay or modify current pending requests.</h3>").addClass("text-danger").fadeIn("slow");
                      }
                      else
                      {
                        if(!data.id && data != 0)
                        {
                          $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Request was not submitted. Plese refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
                        }
                        else
                        {
                          $("#exampleCloseButton2").click();
                          $("#formdata")
                          .html("<h3><i class='icon wb-check-circle'></i></h3><h3>Request Submitted. You Will Be Notified Once Your Request is Approved.</h3>")
                          .removeClass("text-danger").addClass("text-success text-center").fadeIn("slow");
                          location.reload();
                        }
                      }
                    });
                  });
}
}
$(function(){
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("#my-dropzone", {
    url:'/abreqemp',
    autoProcessQueue:false,
    acceptedFiles:'image/png, image/jpeg, image/jpg, application/pdf, docx, doc',
    uploadMultiple:false,
    maxFiles:1,
    dictDefaultMessage:"Supporting Documents",
    addRemoveLinks:'dictCancelUpload',
    parallelUploads:1,
    dictInvalidFileType:"Supported File Types: .png,.jpeg, .jpg, .pdf, .docx,.doc",
    maxFilesize:0.0642,
    dictFileTooBig: 'Warning: File cannot be larger than 62kb'

  });
  myDropzone.on("sending", function(file,xhr,formData) {
    formData.append('_token',     $("#requesttoken").val());
    formData.append('startdate',  $("#start_date").val());
    formData.append('enddate',    $("#end_date").val());
    formData.append('pay',      $('input[name=paystatus]:checked').val());
    formData.append('priority',   $("#priority").val());
    formData.append('type',     $("#abtype").val());
    formData.append('reason',     $("#reason").val());
    formData.append('total',    $("#totalreq").val());
  });
  myDropzone.on("success", function(file,response) {
    console.log(response);
    if(response == 0)
    {
      $("#exampleCloseButton").click();
      $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>You have exhausted your leave credit. You can only apply for a leave without pay or modify current pending requests.</h3>").addClass("text-danger").fadeIn("slow");
    }
    else
    {
      if(!response.id && response != 0)
      {
        $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Request was not submitted. Plese refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
      }
      else
      {
        $("#exampleCloseButton2").click();
        $("#formdata")
        .html("<h3><i class='icon wb-check-circle'></i></h3><h3>Request Submitted. You Will Be Notified Once Your Request is Approved.</h3>")
        .removeClass("text-danger").addClass("text-success text-center").fadeIn("slow");
        location.reload();
      }
    }
  });
  myDropzone.on("error", function(file,response) {
                  //swal('error',response,'error');
                  console.log(response);
                  $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Unfortunately! We experienced a difficulty in saving your current request. Please refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
                  myDropzone.removeFile(file);
                });

  myDropzone.on("complete", function(file) {
    myDropzone.removeFile(file);
  });

  $("#submitrequest").click(function(){
    var startdate   = $("#start_date").val();
    var enddate   = $("#end_date").val();
    var paystat   = $('input[name=paystatus]:checked').val();
    var priority  = $("#priority").val();
    var type    = $("#abtype").val();
    var reason    = $("#reason").val();
    var file    = $('#input-file-disable-remove').prop('files');
    var token     = $("#requesttoken").val();

    if(!startdate || startdate == '')
    {
      $("#starterror").text("Please select a start date.").fadeIn("slow");
    }
    else
    {
      $("#starterror").text("Please select a start date.").fadeOut("slow"); 
    }
    if(!enddate || enddate == '')
    {
      $("#enderror").text("Please select a valid end date").fadeIn("slow");
    }
    else
    {
      $("#enderror").text("Please select a valid end date").fadeOut("slow");  
    }
    if(!priority || priority == '')
    {
      $("#priorityerror").text("Please select a valid priority").fadeIn("slow");
    }
    else
    {
      $("#priorityerror").text("Please select a valid priority").fadeOut("slow");
    }
    if(!type || type == '')
    {
      $("#aberror").text("Please select a valid absence type").fadeIn("slow");
    }
    else
    {
      $("#aberror").text("Please select a valid absence type").fadeOut("slow");
    }
    if(!reason || reason == '')
    {
      $("#reasonerror").text("Enter a valid reason").fadeIn("slow");
    }
    else
    {
      $("#reasonerror").text("Enter a valid reason").fadeOut("slow"); 
    }
    myDropzone.processQueue();
  });
});



function modifyRequest(id, operation)
{
  var token     = $("#_request_token").val();
  if(operation == 1)
  {
    //modify
    swal({
      title: "MODIFY?",
      text: "You are about to alter this request's date parameters!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, continue!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        var startdate   = $("#modstart"+id).val();
        var enddate   = $("#modend"+id).val();

        var formData = {'startdate':startdate, 'enddate':enddate, 'id':id, '_token':token};
        $.get('/modifyRequest?type='+operation, formData, function(data,xhr,status){
          if(data==1)
          {
            swal("Modified!", "Changes Saved Successfully!", "success");
            location.reload();
          }
          else
          {
            swal("Failed!", "Something went wrong while trying to modify your request! Please refresh your browser and try again", "error");
          }
        });
      } else {
        swal("Cancelled", "The Operation Was Cancelled.", "warning");
      }
    });
  }
  else
  {
    //delete
    swal({
      title: "You are about to delete this leave request?",
      text: "This Operation Cannot Be Reversed!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        var formData = {'id':id, '_token':token};
        $.get('/modifyRequest?type='+operation, formData, function(data,xhr,status){
          if(data == 1)
          {
            swal("Deleted!", "Absence Request has been withdrawn.", "success");
            location.reload();
          }
          else
          {
            swal("Failed!", "Something went wrong while trying to delete your request! Please refresh your browser and try again.", "error");
          }
        });
      } else {
        swal("Cancelled", "The Operation Was Cancelled", "warning");
      }
    });
  }
}
</script>
</div>
<div class="form-group">
  <button type="button" class="btn btn-primary" id="submitrequest">Submit</button>
</div>
</div>
</div>
</div>
<!-- End Second Row -->
</div>

<div class="col-ms-12 col-xs-12 col-md-6">
  <div class="card card-shadow" style="height: 550px;">
    <div class="card-header card-header-transparent p-y-20">
      <span class="text-danger" id="starterror"></span><br>
      <span class="text-danger" id="enderror"></span><br>
      <span class="text-danger" id="priorityerror"></span><br>
      <span class="text-danger" id="reasonerror"></span><br>
      <span class="text-danger" id="policyerror"></span><br>
      <span class="text-danger" id="aberror"></span><br>
      <span class="text-danger" id="formdata" style="text-align: center;margin-left: auto;margin-right: auto;display: block;"></span><br>
    </div>
  </div>
  <!-- End Second Row -->
</div>
</div>
<!-- End Page -->
<a class="btn btn-danger btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="You have exhausted your leave credit. You can only apply for a leave without pay or modify current pending requests." data-title="Absence Request" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

<a class="btn btn-danger btn-outline" id="exampleCloseButton2" data-plugin="toastr" data-message="Request Submitted. You Will Be Notified Once Your Request is Approved." data-title="Absence Request" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

<!-- Holidays Modal -->
<div class="modal fade modal-super-scaled" id="holidays" aria-hidden="false" aria-labelledby="exampleFillIn" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="exampleFillInModalTitle"><i class="icon ion-android-plane"></i> Recognized Public Holidays</h4>
      </div>
      <div class="modal-body">
        <?php if(count($holidays) <= 0): ?>
        <h4>No Public Holidays Set Yet.</h4>
        <?php else: ?>
        <?php $counter = 0; $totaldays=''; ?>
        <table class="table table-hover borderless">
          <thead>
            <tr>
              <th>#</th>
              <th>TITLE</th>
              <th>START</th>
              <th>END</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
              <td><?php echo e($counter+=1); ?></td>
              <td><?php echo e($holiday->title); ?></td>
              <td><?php echo e($holiday->start_date); ?></td>
              <td><?php echo e($holiday->end_date); ?></td>
            </tr>
            <?php $totaldays += app('App\Http\Controllers\EmployeeController')->daysBetween($holiday->start_date, $holiday->end_date); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <tr>
              <th colspan="3">
                TOTAL NUMBER OF DAYS
              </th>
              <th>
                <?php echo e($totaldays); ?>

              </th>
            </tr>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- End Holidays Modal -->


<!-- Leave Bank Modal -->
<div class="modal fade modal-super-scaled" id="categories" aria-hidden="false" aria-labelledby="exampleFillIn" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="exampleFillInModalTitle"><i class="icon ion-ios-browsers"></i> Absence Categories</h4>
      </div>
      <div class="modal-body">
        <?php if(count($leaves) <= 0): ?>
        <h4>Category Bank is Empty.</h4>
        <?php else: ?>
        <?php $counter = 0; ?>
        <div class="table-responsive">
          <table class="table table-hover borderless">
            <thead>
              <tr>
                <th>#</th>
                <th>NAME</th>
                <th>DAYS TOTAL</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <th><?php echo e($counter+=1); ?></th>
                <th><?php echo e($leave->name); ?></th>
                <th><?php echo e($leave->days); ?></th>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tbody>
          </table>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- End Leave Bank Modal -->


<!-- Leave Requests Modal -->
<div class="modal fade modal-super-scaled" id="requests" aria-hidden="false" aria-labelledby="exampleFillIn" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="exampleFillInModalTitle"><i class="icon ion-ios-browsers"></i> Absence Requests</h4>
      </div>
      <div class="modal-body">
        <?php if(count($requests) <= 0): ?>
        <h4>You Have Not Made Any Leave Requests For This Fiscal Year</h4>
        <?php else: ?>
        <?php $counter = 0; $totalreqdays=''; ?>
        <div class="table-responsive">
          <table class="table table-hover borderless">
            <thead>
              <tr>
                <th>#</th>
                <th>START DATE</th>
                <th>END DATE</th>
                <th>L.M. APPR.</th>
                <th>L.M. COMMENT</th>
                <th>HR APPR.</th>
                <th>HR COMMENT</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <th><?php echo e($counter+=1); ?></th>
                <th><?php echo e($request->startdate); ?></th>
                <th><?php echo e($request->enddate); ?></th>
                <th><?php echo status($request->lm_approve); ?></th>
                <?php if($request->lm_comments==NULL): ?>
                <th>No comments yet.</th>
                <?php else: ?>
                <th><?php echo e($request->lm_comments); ?></th>
                <?php endif; ?>
                <th><?php echo status($request->admin_approve); ?></th>
                <?php if($request->admin_comments==NULL): ?>
                <th>No comments yet.</th>
                <?php else: ?>
                <th><?php echo e($request->admin_comments); ?></th>
                <?php endif; ?>
                <th><?php echo status($request->status); ?></th>
                <th>
                  <?php if($request->status == 1): ?>
                  <a class="text-success" href="javascript:void(0)" title="LOCKED. THIS REQUEST CANNOT BE MODIFIED"><i class="icon wb-lock"></i></a>
                  <?php elseif($request->lm_approve == 1 || $request->admin_approve == 1 || $request->board_approve == 1 || $request->lm_approve == 2 || $request->admin_approve == 2 || $request->board_approve == 2 || $request->status == 2 ): ?>
                  <a class="text-success" href="javascript:void(0)" title="LOCKED. AWAITING FURTHER RESPONSE"><i class="icon wb-lock"></i></a>
                  <?php else: ?>
                  <a class="text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modify<?php echo e($request->id); ?>" title="MODIFY"><i class="icon wb-edit"></i></a>
                  <a class="text-danger" href="javascript:void(0)" onclick="modifyRequest(<?php echo e($request->id); ?>, 2)" title="DELETE"><i class="icon wb-power"></i></a>
                  <?php endif; ?>
                </th>
              </tr>
              <?php $totalreqdays += app('App\Http\Controllers\EmployeeController')->daysBetween($request->startdate, $request->enddate); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <th colspan="7">TOTAL NUMBER OF DAYS</th>
                <th colspan="2"><?php echo e($totalreqdays); ?></th>
                <input type="hidden" name="totalreq" id="totalreq" value="<?php echo e($totalreqdays); ?>">
              </tr>
            </tbody>
          </table>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- End Leave Requests Modal -->

<!-- Modal to Modify Absence Requests -->
<?php if(count($requests) > 0): ?>
<?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<div class="modal fade" id="modify<?php echo e($request->id); ?>" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg modal-sidebar">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Modify Absence Request</h4>
        <h5>Change Request Date</h5>
      </div>
      <div class="modal-body">
        <div class="row" style="width: 400px;">
          <div class="form-group col-xs-12 col-md-12">
            <label class="form-control-label">REASON</label>
            <textarea class="form-control" style="height: 100px;resize: none;" disabled="disabled"><?php echo e($request->reason); ?></textarea>
          </div>
          <div class="form-group col-xs-12 col-md-12">
            <label class="form-control-label">PAYMENT STATUS</label>
            <span>
              <?php if($request->pay == 1): ?>
              <input type="text" name="" id="" class="form-control" value="With Pay" disabled="disabled">
              <?php else: ?>
              <input type="text" name="" id="" class="form-control" value="Without Pay" disabled="disabled">
              <?php endif; ?>
            </span>
          </div>
          <div class="form-group col-xs-12 col-md-12">
            <label class="form-control-label">STATUS</label>
            <?php echo status($request->status); ?>

          </div>
          <div class="form-group col-xs-12 col-md-12">
            <label class="form-control-label">START DATE</label>
            <input type="text" name="modstart<?php echo e($request->id); ?>" id="modstart<?php echo e($request->id); ?>" class="form-control" value="<?php echo e($request->startdate); ?>" autocomplete="off" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
          </div>
          <div class="form-group col-xs-12 col-md-12">
            <label class="form-control-label">END DATE</label>
            <input type="text" name="modend<?php echo e($request->id); ?>" id="modend<?php echo e($request->id); ?>" class="form-control" value="<?php echo e($request->enddate); ?>" autocomplete="off" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row" style="width: 400px;">
          <div class="form-group col-xs-12 col-md-12">
            <button type="button" class="btn btn-success btn-block" onclick="modifyRequest(<?php echo e($request->id); ?>, 1)">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?>
<!-- End Modal To Modify Absence Requests -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
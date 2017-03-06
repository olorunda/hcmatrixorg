<?php echo $__env->make('layouts.header', ['page_title' => 'Salary component List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Salary component List</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
            
             <?php if(session('success')): ?>
                <div class="flash-message">
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
                </div>
            <?php endif; ?> 
			<?php if(count($errors)>0): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?> 
                </div>
                </div>
            <?php endif; ?> 
            <div class="flash-message">
                <div class="alert alert-success" id="status_div" style="display:none;">
                    Salary component status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddAllowance()">Add Salary component</button><!--&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnImport()">Import Allowance / Deductions</button><br/><a href="public/sample_files/allowance_import_format.xlsx" target="_blank">Sample Excel File</a>--></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>                               
                              <th>S.No</th>
                              <th>Job Role</th>
                              <th>Name</th>                      
                              <th>Allowance / Deduction</th>                              
                              <th>Charge Percentage</th>
                              <th>Charge Formula</th>
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>                                
                                <td><?php echo e($sno++); ?> </td>
                                <td><?php if($allowance->job_role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                                    <?php if($allowance->job_role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                                    <?php if($allowance->job_role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                                    <?php if($allowance->job_role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                                    <?php if($allowance->job_role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?></td>
                                <td><?php echo e($allowance->name); ?></td>
                                <td><?php if($allowance->is_allowance==1): ?> <?php echo e('Allowance'); ?> <?php else: ?> <?php echo e('Deduction'); ?> <?php endif; ?></td>
                                <td><?php if($allowance->is_formula==0): ?><?php echo e($allowance->charge_percentage); ?> <?php endif; ?></td>
                                <td><?php echo e($allowance->charge_formula); ?></td>
                                <td class="actions" id="status_div_<?php echo e($allowance->id); ?>"><?php if($allowance->status==0): ?> <aonclick="fnStatusChange(<?php echo e($allowance->id); ?>,<?php echo e($allowance->status); ?>, <?php echo e($allowance->is_allowance); ?>)"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active" ></i></a> <?php else: ?> <a onclick="fnStatusChange(<?php echo e($allowance->id); ?>,<?php echo e($allowance->status); ?>, <?php echo e($allowance->is_allowance); ?>)"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> <?php endif; ?></td>
                                <td class="actions"><a onClick="fnEditAllowance(<?php echo e($allowance->id); ?>)"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><!--<a onClick="fnDelete(<?php echo e($allowance->id); ?>, <?php echo e($allowance->is_allowance); ?>)"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a>--></td>
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
                      </tbody> 
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
  
  <!--- Add allowance modal start -->
  <div class="modal fade in" id="allowance-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_allowance_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="allowance_title">Add Allowance / Deduction</h4>
        </div>
        <div class="modal-body">         
            <?php echo e(csrf_field()); ?>     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <?php //print_r($roles); ?>
                <label class="example-title">Job Role&nbsp;<span class="required_filed">*</span></label>
                <select class="form-control" id="job_role" name="job_role">
                  <option value = ''>Select</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>  
                      <?php if($role->role!='' && $role->role!=0): ?>
                        <option value = "<?php echo e($role->role); ?>" <?php echo e(((old("job_role")!='' && old("job_role") ==  $role->role) || (isset($allowance) && $allowance->job_role!='' && $allowance->job_role ==  $role->role)) ? "selected=selected":""); ?>>
                          <?php if($role->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                        </option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>                   
                  </select>                 
              </div>
              <div id="job_role_err"></div>
              <div class="form-group">
                <label class="example-title">Allowance / Deduction&nbsp;<span class="required_filed">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="allowance" name="is_allowance" value="1" <?php echo e(((old("is_allowance")!='' && old("is_allowance") ==  1) || (isset($allowance_details) && $allowance_details->is_allowance!='' && $allowance_details->is_allowance ==  1)) ? "checked=checked":""); ?>>&nbsp;Allowance&nbsp;&nbsp;
                <input type="radio" id="deduction" name="is_allowance" value="0" <?php echo e(((old("is_allowance")!='' && old("is_allowance") ==  0) || (isset($allowance_details) && $allowance_details->is_allowance!='' && $allowance_details->is_allowance ==  0)) ? "checked=checked":""); ?>>&nbsp;Deduction
              </div>
              <div id="is_allowance_err"></div>

              <div class="form-group">
                <label class="example-title">Charge Name&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Charge Name" value="<?php echo e(old('name')!='' ? old('name') : ((isset($allowance_details) && $allowance_details->name!='') ? $allowance_details->name : '')); ?>">               
              </div>
              <div id="name_err"></div> 
              <div class="form-group">
                <label class="example-title">Percentage / Formula&nbsp;<span class="required_filed">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="chrg_percentage" name="is_formula" onclick="fnChangeCharge(this.value)" value="0" <?php echo e(((old("is_formula")=='' || old("is_formula") ==  0) || (isset($allowance_details) && ($allowance_details->is_formula=='' || $allowance_details->is_formula ==  0))) ? "checked=checked":""); ?>>&nbsp;Percentage&nbsp;&nbsp;
                <input type="radio" id="chrg_formula" name="is_formula" onclick="fnChangeCharge(this.value)" value="1" <?php echo e(((old("is_formula")!='' && old("is_formula") ==  1) || (isset($allowance_details) && $allowance_details->is_formula!='' && $allowance_details->is_formula ==  1)) ? "checked=checked":""); ?>>&nbsp;Formula                
              </div>
              <div id="is_formula_err"></div>
              <div id="charge_percentage_div">
              <div class="form-group">
                <label class="example-title">Charge in Percentage&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="charge_percentage" name="charge_percentage" placeholder="Charge in Percentage" value="<?php echo e(old('charge_percentage')!='' ? old('charge_percentage') : ((isset($allowance_details) && $allowance_details->charge_percentage!='') ? $allowance_details->charge_percentage : '')); ?>">               
              </div>
              <div id="charge_percentage_err"></div>   
            </div>    
            <div id="charge_formula_div" style="display:none;">
              <div class="form-group">
                <label class="example-title">Charge Formula&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="charge_formula" name="charge_formula" placeholder="Charge Formula" value="<?php echo e(old('charge_formula')!='' ? old('charge_formula') : ((isset($allowance_details) && $allowance_details->charge_formula!='') ? $allowance_details->charge_formula : '')); ?>">               
              </div>
              <div id="charge_formula_err"></div>  
              <table class="table table-hover tabletable-striped" id="data_table">
                <thead> 
                  <tr>
                    <th>Field Name</th>
                    <th>Constant</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Basic Pay</td>
                    <td>[[basic_pay]]</td>
                  </tr>
                  <tr>
                    <td>Housing Allowance</td>
                    <td>[[housing_allowance]]</td>
                  </tr>
                  <tr>
                    <td>Transport Allowance</td>
                    <td>[[transport_allowance]]</td>
                  </tr>
                  <tr>
                    <td>Gross Salary</td>
                    <td>[[gross_salary]]</td>
                  </tr>
                </tbody>
              </table> 
            </div>     
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php if(isset($id) && $id!=''): ?> <?php echo e($id); ?><?php endif; ?>">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="allowance_btn" value="Save" onclick ="fnAllowance()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'allowance-list';"></span></div>
                
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add allowance modal end -->
  <!-- Footer -->
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -2, -1 ] }
    ]
    });


  function fnChangeCharge(arg) {
    if(arg==0)
    {
      $("#charge_percentage_div").css("display","block");
      $("#charge_formula_div").css("display","none");
      $("#charge_percentage_err").html('');
      $("#charge_percentage").val('');
    }

    if(arg==1)
    {
      $("#charge_percentage_div").css("display","none");
      $("#charge_formula_div").css("display","block");
      $("#charge_formula_err").html('');
    }
    }

  function fnDelete(arg,is_allowance)
    {
      var type;
      if(is_allowance==1)
        type = "allowance";
      else
        type = "deduction";
      if(confirm("Do you really want to delete this "+type+"?"))
      {
        document.location.href="delete_allowance/"+arg;
      }
    }

    function fnStatusChange(arg,status,is_allowance)
    {
      $.ajax({
        type: "POST",
        url: "allowance_status_change",
        data: "_token=<?php echo csrf_token() ?>&id="+arg+"&status="+status,
        dataType: "json", 
        
        beforeSend: function(){ $("#status_div_"+arg).html("Updating...");},       
        success: function(response){ 
          if(response.Success==1)
          {
            $("#status_div_"+arg).html(response.status_div);
            $(".alert").css('display', 'none');
            $("#status_div").css('display', 'block');
          }
        }     
      });
    }


  //Add allowance
  function fnAddAllowance()
  {
    $("#allowance_title").html("Add Allowance / Deduction");
    $(".alert").remove();
    $("#allowance_btn").val("Save");
    $("#add_allowance_form")[0].reset();
    $("#allowance-modal").modal("show");
  }

  //Edit allowance
  function fnEditAllowance(arg)
  {
    $("#allowance_title").html("Edit Allowance / Deduction");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-allowance/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var allowance_details = response.allowance_details;
          //filling the old values
          $("#job_role").val(allowance_details.job_role);
          if(allowance_details.is_allowance==1)           
            $("#allowance").attr('checked','checked');  
          else
            $("#deduction").attr('checked','checked');  
          if(allowance_details.is_formula==0)           
          {
            $("#chrg_percentage").attr('checked','checked');  
            $("#charge_percentage_div").css("display","block");
            $("#charge_formula_div").css("display","none");
          }
          if(allowance_details.is_formula==1)           
          {
            $("#chrg_formula").attr('checked','checked');  
            $("#charge_formula_div").css("display","block");
            $("#charge_percentage_div").css("display","none");
          }
          $("#charge_formula").val(allowance_details.charge_formula);           
          $("#name").val(allowance_details.name); 
          $("#charge_percentage").val(allowance_details.charge_percentage);     
          $("#id").val(allowance_details.id);
          $("#allowance_btn").val("Update");
          $("#allowance-modal").modal("show");
          
        }     
      });
  }

  function fnAllowance()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-allowance';
      else
          url = 'add-allowance';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_allowance_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="allowance_btn" value="Update" onclick ="fnAllowance()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="allowance_btn" value="Save" onclick ="fnAllowance()">');
          if(response.Success==1)
          {
            $("#add_allowance_form")[0].reset();
            window.location.href = "allowance-list";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="allowance_btn" value="Update" onclick ="fnAllowance()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="allowance_btn" value="Save" onclick ="fnAllowance()">');
        var errors = data.responseJSON;
        if(errors.job_role)
        {
          $("#job_role_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.job_role+'</strong></div></div>');
        }
        if(errors.is_allowance)
        {
          $("#is_allowance_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.is_allowance+'</strong></div></div>');
        }
       
        if(errors.name)
        {
          $("#name_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.name+'</strong></div></div>');
        }
        if(errors.charge_percentage)
        {
          $("#charge_percentage_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.charge_percentage+'</strong></div></div>');
        }
        if(errors.charge_formula)
        {
          $("#charge_formula_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.charge_formula+'</strong></div></div>');
        }
        if(errors.is_formula)
        {
          $("#is_formula_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.is_formula+'</strong></div></div>');
        }
        
        
      }   
      });
    }

  </script>
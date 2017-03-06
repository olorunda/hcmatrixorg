@include('layouts.header', ['page_title' => 'Successor Vacancy List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Vacancy List</h1>     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">
            @if (session('success'))
                <div class="flash-message">
                <div class="alert alert-success">
                    Successor added successfully!
                </div>
                </div>
            @endif
            @if (session('error'))
                <div class="flash-message">
                <div class="alert alert-danger">
                    Successor already added!
                </div>
                </div>
            @endif
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" >
                <div class="card-block p-0">
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Vacant Position</th> 
                              <th>Instead of whom</th>
                              <th>Short Description</th>
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($vacancies as $vacancy)                            
                            <tr>
                                <td>{{$sno++}} </td>
                                <td>{{$vacancy->vacant_position}}</td>
                                <td>{{$vacancy->instead_of_whom}}</td>
                                <td><p>{{ $vacancy->description }}</p></td>
								                <td class="actions"><a onclick="fnSubmit('{{ $vacancy->id }}','{{$vacancy->vacant_position}}')"><i class="btn btn-sm btn-primary waves-effect icon fa-plus" aria-hidden="true" title="Nominate Successor"></i></a></td>
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>
                </div>                  
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
  <!-- Modal -->
 <div class="modal fade in" id="nomination-modal" role="dialog">
    <div class="modal-dialog ">
      <form id="nomination_form"  method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nominate Successors</h4>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <label class="example-title">Vacancy Details</label>
                <p id="vacant_position"></p>         
              </div>
              <div class="form-group">
                <label class="example-title">Employee&nbsp;<span class="required_filed">*</span></label>
                <select class="form-control" id="employee_id" name="employee_id">
                  <option value = ''>Select</option>
                    @foreach($employees as $employee)  
                      @if($employee->id!='')
                        <option value = "{{ $employee->id}}">{{ $employee->name}} ({{$employee->emp_num}})</option>
                      @endif
                    @endforeach                   
                  </select>             
              </div>
              <div id="employee_id_err"></div> 
              <div class="form-group">
                <label class="example-title">Comments</label>
                <textarea name ="comments" id="comments" class="form-control"></textarea>           
              </div>
              <div id="comments_err"></div> 
			        <input type="hidden" name="vacancy_id" id = "vacancy_id" value="">         
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnNominate()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'nominate-successor';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
 <!-- Modal end -->
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
    function fnSubmit(vacancy_id,vacant_position)
    {
      $("#vacancy_id").val(vacancy_id);
      $("#vacant_position").html(vacant_position);
	    $("#nomination-modal").modal('show');
    }


  function fnNominate()
    {
      $(".alert").remove();      
      $.ajax({
        type: "POST",
        url: 'successorcreate',
        data :   $("#nomination_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){          
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnNominate()">');
          if(response.Success==1)
          {
            $("#nomination_form")[0].reset();
            window.location.href = "nominate-successor";
          }
        } ,
         error: function(data){          
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnNominate()">');
        var errors = data.responseJSON;
        if(errors.employee_id)
        {
          $("#employee_id_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.employee_id+'</strong></div></div>');
        }
        if(errors.comments)
        {
          $("#comments_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.comments+'</strong></div></div>');
        }
      }   
      });
    }
  </script>
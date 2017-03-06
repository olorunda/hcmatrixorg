@include('layouts.header', ['page_title' => 'Applied Training List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Applied Training List</h1>
     
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
           <div class="sync-alert" style="display:none;">
			  <div class="flash-message">
                <div class="alert alert-success">
                    Calendar event synced to your email successfully!
                </div>
           </div>
			  </div><!-- end of  sync-alert -->
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Training Name</th> 
                              <th>Training Duration</th> 
                              <th>Training Location</th> 
                              <th>Capacity</th>                              
                              <th>Status</th> 
							                <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody>
                      <?php $sno = 1; ?>
                          @foreach ($trainings as $training) 
          								<?php $training_materials = array(); ?>
          								@if($training->materials!='')
          								  <?php $training_materials = explode(",",$training->materials); ?>						  
          								@endif 
                            <tr>
                                <td>{{$sno++}} </td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ date("M d, Y", strtotime($training->start_date)) }} to {{ date("M d, Y", strtotime($training->end_date)) }}</td>
                                <td>{{ $training->location }}</td>
                                <td>{{ $training->capacity }}</td>
                                <td>@if($training->status==Config::get('constants.training_status.APPLIED')) {{'Applied'}} @endif
				    @if($training->status==Config::get('constants.training_status.APPROVED')) {{'Approved'}} @endif
                          	    @if($training->status==Config::get('constants.training_status.WAITING')) {{'Waiting List'}} @endif
				    @if($training->status==Config::get('constants.training_status.NOT_APPROVED')) {{'Not Approved'}}  @endif
									</td>   
								<td class="actions"> 
								@if($training->status==2 && count($training_materials)>0)
                <a onclick ="fnDownload('{{$training->materials}}', '{{$training->material_name}}')" download target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-download" aria-hidden="true"   title="Download Materials"></i></a>@endif
								@if($training->status==Config::get('constants.training_status.APPROVED')) 
									@if($training->sync_status!=1) 
									<div id="sync_{{ $training->id }}" style="display:inline-block;"> <a onclick="sync_calander({{ $training->id }})"><i class="fa fa-link btn btn-success btn-sm" aria-hidden="true" title="Sync To Outlook Calendar" ></i></a> </div> 
									@else
									<span class="btn-info" style="padding: 0 5px;" title="Synced To Outlook Calendar"><i class="btn-sm fa fa-check"></i>Synced</span>
									@endif 
									@endif
								</td>    									
									
                            </tr>                            
                            @endforeach 
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
  <!-- Footer -->
  @include('layouts.footer')
  <!-- modal start -->
    <div id='modal-download-materials' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('import-training') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Download Training Materials</h4>
          </div>
          <div class="modal-body">
            <div class="row row-lg col-xs-12" id="material_div">  
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  <!-- modal end -->
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
  //outlook calendar syncing function
	function sync_calander(tid)
	{
		//$("#sync_"+tid).html('<span class="btn-success" style="padding: 0 5px;" title="Synced To Outlook Calendar"><i class="fa fa-check"></i>Synced</span>');
		//$(".sync-alert").show();
		$.ajax({
        type: "POST",
        url: "sync-calendar",
        data: "_token=<?php echo csrf_token() ?>&id="+tid,
        dataType: "json", 
        
        beforeSend: function(){ $("#sync_"+tid).html("Syncing...");},       
        success: function(response){ 
          if(response.Success==1)
          {
            $("#sync_"+tid).html(response.sync_div);
			$(".sync-alert").show();
          }
        }     
      });
	}
	
	
	function fnDownload(arg1,arg2)
    {
      var materials = arg1.split(',');
      var material_names = arg2.split(',');
      var html = '';
      for(var i=0;i<(materials.length);i++)
      {
        if(materials[i]!='' && material_names[i]!='')
        {
          html= html+'<div class="col-xs-6">'+material_names[i]+'&nbsp;&nbsp;&nbsp;<a href="public/uploads/'+materials[i]+'" target="_blank"><i class="btn btn-success waves-effect icon fa-download" aria-hidden="true"></i></a></div>';
        }
      }
      $("#material_div").html(html);
      
     $("#modal-download-materials").modal('show');
    }
</script>
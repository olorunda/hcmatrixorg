@include('layouts.header', ['page_title' => 'Survey view'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Survey view</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
            
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  @foreach ($surveys as $survey)
				  <div>
                      <h3 style="text-align:center">Filled survey '{{ $survey->survey_name }}' of the training</h3>
                  </div>				  
                  <table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true">
                      <thead> 
                          <tr>
                            <th>Employee name: {{ $survey->emp_name }}</th>
                            <th>Training name: {{ $survey->training_name }}</th>
                            <th>Survey submitted date: {{ date("M d, Y", strtotime($survey->submitted_date)) }}</th>
                          </tr>
                      </thead> 
                      <tbody> <?php                       
                      $questions=explode("^",$survey->question); 
                      $answer=explode("^",$survey->answer); 
                       ?>
                            @for ($i=0; $i < count($questions); $i++) 
                            <tr>
                                <td colspan='4'>
                                    <h4>Question: {{ $questions[$i] }} </h4>                              
                                                                    
                                    &nbsp;&nbsp; Answer: {{ $answer[$i] }}                                                                     
                                </td>
                                
                            </tr>                            
                            @endfor
                      </tbody> 
                  </table>  
                  @endforeach
                  <br/><div class="text-xs-left"><input type="button" class="btn btn-default waves-effect" value="Back" onclick="fnSubmit({{ $survey->training_id }},'{{$back_link}}')"></div>                     
                </div>
              </div>   
<form id="view_form" action="{{ url('/filled-surveys')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "training_id" value="">
                  </form>  			  
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
   function fnSubmit(arg,back_link)
    {
      if(back_link)
        document.location.href=back_link;
      else
      {
        $("#training_id").val(arg);
        $("#view_form").submit();
      }
    }

  </script>
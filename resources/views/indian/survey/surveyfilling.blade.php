@include('layouts.header', ['page_title' => 'Survey form'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Survey form</h1>
     
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
            <div class="flash-message">
                <div class="alert alert-success" id="status_div" style="display:none;">
                    Training status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  @foreach ($surveys as $survey)  
                  <form id="status_form" action="{{ url('/training-survey-add') }}" method="post">
                  <table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">
                      <thead> 
                          <tr>
                              <th colspan="4"><h2 style="text-align:center">Welcome to the {{ $survey->survey_name }} of the training</h2></th> 
                          </tr> 
                      </thead> 
                      <tbody> <?php 
                      //echo '<pre>'; print_r($survey); 
                      $questions=explode("^",$survey->question); 
                      $answers=explode("^^",$survey->answer_option); 
                      //print_r($questions); echo count($questions);                       
                      //exit(); ?>
                            @for ($i=0; $i < count($questions); $i++) 
                            <tr>
                                <td colspan="4">
                                    {{ $questions[$i] }} 
                                    <input type="hidden" name="question[{{$i}}]" value="{{$questions[$i]}}">
                                </td>                                
                            </tr> 
                            <tr>                               
                                <?php $answer=explode("^",$answers[$i]); ?>
                                @for ($j=0; $j < count($answer); $j++)
                                <td> 
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="{{ $answer[$j] }}" name="answer[{{$i}}]" <?php echo $j == 0 ? 'checked':''; ?> >
                                            {{ $answer[$j] }}                                 
                                        </label>
                                    </div>
                                </td>
                                @endfor
                            </tr>                            
                            @endfor
                      </tbody> 
                  </table>  
                  <div class="col-xs-12">
                      <!-- Example Textarea -->
                      <div class="form-group">                        
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="survey_id" value="{{$survey->id}}">
                        <input type="hidden" name="training_id" value="{{$survey->training_id}}">
                        <div class="text-xs-left"><span class="no-left-padding"><input type="submit" class="btn btn-primary waves-effect" value="Save"></span>
                        <span class="no-left-padding"><input type="reset" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'training-survey-list';"></span></div>
                      </div>
                      <!-- End Example Textarea -->
                  </div>
                  </form>
                  @endforeach
                    
                    
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
    function fnStatusChange(id,status)
    {
      $("#training_id").val(id);
      $("#training_status").val(status);
       $("#status_form").submit();
    }

  </script>
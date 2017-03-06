@if(isset($id) && $id!='')  <?php $title = 'Edit Training Survey'; ?> @else <?php $title = 'Add Training Survey'; ?> @endif
@include('layouts.header', ['page_title' => $title])

  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          @if(isset($id) && $id!='') <?php $url = url('/update-survey'); ?>@else <?php $url = url('/add-survey'); ?>@endif
          <form class="form-horizontal" role="form" method="POST" action="<?php echo $url; ?>">           
            {{ csrf_field() }}  
            <?php //print_r($errors->all()); ?>
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-6">
              <div class="form-group">
                <h4 class="example-title">Job Training Name&nbsp;<span class="required_filed">*</span></h4>
                <select class="form-control" id="training_id" name="training_id">
                  <option value = ''>Select</option>
                    @foreach($trainings as $training)  
                      @if($training->training_name!='' && $training->id!=0)
                        <option value = "{{ $training->id}}" {{ ((old("training_id")!='' && old("training_id") ==  $training->id) || (isset($survey_details) && $survey_details->training_id!='' && $survey_details->training_id ==  $training->id)) ? "selected=selected":"" }}>{{$training->training_name}}
                        </option>
                      @endif
                    @endforeach                   
                  </select>                 
              </div>
               @if ($errors->has('training_id'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('training_id') }}</strong>
                      </div>
                    </div>
                  @endif  
              </div>
              <div class="col-xs-6">
              <div class="form-group">
                <h4 class="example-title">Survey Name&nbsp;<span class="required_filed">*</span></h4>
             
                <input type="text" class="form-control" id="survey_name" name="survey_name" placeholder="Survey Name" value="{{ old('survey_name')!='' ? old('survey_name') : ((isset($survey_details) && $survey_details->survey_name!='') ? $survey_details->survey_name : '') }}">
              </div> 
              @if ($errors->has('survey_name'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('survey_name') }}</strong>
                      </div>
                    </div>
                  @endif
            </div>
          </div>
            <div class="col-xs-12">
                  <!-- Questions Section Start-->
                  <div class="text-xs-right">
                    <i class="btn btn-primary waves-effect icon fa-close" aria-hidden="true" onClick="fnRemoveAll()"  title="Edit"></i>
                  </div>
                  <div class="example example-well m-t-0 survey_padding">
                    <input type="hidden" id="total_questions" name="total_questions" value="{{ old('total_questions')!='' ? old('total_questions') : ((isset($survey_details) && $survey_details->total_questions!='') ? $survey_details->total_questions : 1) }}">
                     <div id="survey_questions_div">

                     <?php $tot = old('total_questions')!='' ? old('total_questions') : ((isset($survey_details) && $survey_details->total_questions!='') ? $survey_details->total_questions : 1); ?>

                 @for ($i = 0; $i < ($tot); $i++)  
                 
                <div class="col-xs-6 survey_div" id="examplePanel_{{$i}}">
                  <div  class="examplePanel panel m-b-0">
                  <div class="survey_heading panel-heading">
                    <h3 class="panel-title survey_ques">Question - <span id="ques_cnt" class="ques_cnt">{{$i+1}}</span></h3>
                    <div class="panel-actions">
                      <a class="panel-action icon fa-plus" aria-hidden="true" onclick="fnAdd()"></a>
                      @if($i > 0)&nbsp;&nbsp;<a class="panel-action icon fa-close" aria-hidden="true" onclick="fnRemove({{$i}})"></a>@endif
                    </div>
                  </div>

                  <div class="panel-body">
                    <div class="form-group">
                <h4 class="example-title">Question&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="question1" name="question[{{$i}}]" placeholder="Question" value="{{ old('question.'.$i.'')!='' ? old('question.'.$i.'') : ((isset($survey_details) && $question_array[$i]!='') ? $question_array[$i] : '') }}">               
              </div>
               @if ($errors->has('question.'.$i))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('question.'.$i) }}</strong>
                      </div>
                    </div>
                  @endif
                  <div class="form-group col-sm-6">
                <h4 class="example-title">Option 1&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="answer1" name="answer_option[{{$i}}][0]" placeholder="Answer Option 1" value="{{ old('answer_option.'.$i.'.0')!='' ? old('answer_option.'.$i.'.0') : ((isset($survey_details) && $answer_array[$i][0]!='') ? $answer_array[$i][0] : '') }}">  
                  @if ($errors->has('answer_option.'.$i.'.0'))
                    <br/><div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('answer_option.'.$i.'.0') }}</strong>
                      </div>
                    </div>
                  @endif             
              </div>
               
                  <div class="form-group col-sm-6">
                <h4 class="example-title">Option 2&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="answer_option2" name="answer_option[{{$i}}][1]" placeholder="Answer Option 2" value="{{ old('answer_option.'.$i.'.1')!='' ? old('answer_option.'.$i.'.1') : ((isset($survey_details) && $answer_array[$i][1]!='') ? $answer_array[$i][1] : '') }}">   
                @if ($errors->has('answer_option.'.$i.'.1'))
                    <br/><div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('answer_option.'.$i.'.1') }}</strong>
                      </div>
                    </div>
                  @endif            
              </div>
               
                  <div class="form-group col-sm-6">
                <h4 class="example-title">Option 3&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="answer_option3" name="answer_option[{{$i}}][2]" placeholder="Answer Option 3" value="{{ old('answer_option.'.$i.'.2')!='' ? old('answer_option.'.$i.'.2') : ((isset($survey_details) && $answer_array[$i][2]!='') ? $answer_array[$i][2] : '') }}">  
                @if ($errors->has('answer_option.'.$i.'.2'))
                    <br/><div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('answer_option.'.$i.'.2') }}</strong>
                      </div>
                    </div>
                  @endif            
              </div>
               
                  <div class="form-group col-sm-6">
                <h4 class="example-title">Option 4&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="answer_option4" name="answer_option[{{$i}}][3]" placeholder="Answer Option 4" value="{{ old('answer_option.'.$i.'.3')!='' ? old('answer_option.'.$i.'.3') : ((isset($survey_details) && $answer_array[$i][3]!='') ? $answer_array[$i][3] : '') }}"> 
                @if ($errors->has('answer_option.'.$i.'.3'))
                    <br/><div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('answer_option.'.$i.'.3') }}</strong>
                      </div>
                    </div>
                  @endif          
              </div>
               
                  </div>
                </div>
                </div> 
                @if($i%2!=0)
                  <div class="clearfix" id="clearfix_{{$i}}"></div>
                @endif
                @endfor
                 <div id="more_questions"></div>
              </div>

            
            </div>          
            <!-- Question Section End -->
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding"><input type="submit" class="btn btn-primary waves-effect" value="@if(isset($id) && $id!='') {{ 'Update' }} @else {{ 'Save' }}@endif"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = '{{ url('/survey-list')}}';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>

  
  </div>
  <!-- End Page -->
  <!-- Footer -->
  @include('layouts.footer')
  <script>
 function fnAdd()
 {
  var tot = eval($("#total_questions").val());
  var arrcnt = tot;
  var cnt = tot+1;
  $("#total_questions").val(tot+1);
  var html;

  html = '<div class="col-xs-6 survey_div" id="examplePanel_'+cnt+'"><div class="examplePanel panel m-b-0" data-load-callback="customRefreshCallback"><div class="survey_heading panel-heading"><h3 class="panel-title survey_ques">Question - <span id="ques_cnt" class="ques_cnt">'+cnt+'</span></h3><div class="panel-actions"><a class="panel-action icon fa-plus" aria-hidden="true" onclick="fnAdd()"></a>&nbsp;&nbsp;<a class="panel-action icon fa-close" aria-hidden="true" onclick="fnRemove('+cnt+')"></a></div></div>';

  html = html+'<div class="panel-body"><div class="form-group"><h4 class="example-title">Question&nbsp;<span class="required_filed">*</span></h4><input type="text" class="form-control" id="question1" name="question[]" placeholder="Question" value=""></div>';
              
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 1&nbsp;<span class="required_filed">*</span></h4><input type="text" class="form-control" id="answer1" name="answer_option['+arrcnt+'][0]" placeholder="Answer Option 1" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 2&nbsp;<span class="required_filed">*</span></h4><input type="text" class="form-control" id="answer2" name="answer_option['+arrcnt+'][1]" placeholder="Answer Option 2" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 3&nbsp;<span class="required_filed">*</span></h4><input type="text" class="form-control" id="answer3" name="answer_option['+arrcnt+'][2]" placeholder="Answer Option 3" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 4&nbsp;<span class="required_filed">*</span></h4><input type="text" class="form-control" id="answer4" name="answer_option['+arrcnt+'][3]" placeholder="Answer Option 4" value=""></div>';             
  html = html+'</div></div></div>';

  if(tot%2!=0)
    html = html+'<div class="clearfix" id="clearfix_'+cnt+'"></div>';

                $("#more_questions").append(html);
 }

 function fnRemove(arg)
 {
  //alert(arg);
  var cnt = eval($("#total_questions").val())-1;
  $("#total_questions").val(cnt);
  //

  if(arg%2==0)
   $( "#clearfix_"+arg).remove();   
 
$( "#examplePanel_"+arg).remove();

  var fields = $('.examplePanel');
var count = 1;
$.each(fields, function() {
  //console.log($(this).children(".ques_cnt"));
    $(this).attr('id','examplePanel_' + count);
    $(this).find(".ques_cnt").html(count);
    count++;
});
 }

 function fnRemoveAll()
 {
  $("#total_questions").val(1);

  var cnt = 1;
  var arrcnt  = 1;
  var html;

   html = '<div class="col-xs-6 survey_div" id="examplePanel_'+cnt+'"><div class="examplePanel panel m-b-0" data-load-callback="customRefreshCallback"><div class="survey_heading panel-heading"><h3 class="panel-title survey_ques">Question - <span id="ques_cnt" class="ques_cnt">'+cnt+'</span></h3><div class="panel-actions"><a class="panel-action icon fa-plus" aria-hidden="true" onclick="fnAdd()"></a></div></div>';

  html = html+'<div class="panel-body"><div class="form-group"><h4 class="example-title">Question</h4><input type="text" class="form-control" id="question1" name="question[]" placeholder="Question" value=""></div>';
              
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 1</h4><input type="text" class="form-control" id="answer1" name="answer_option['+arrcnt+'][0]" placeholder="Answer Option 1" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 2</h4><input type="text" class="form-control" id="answer2" name="answer_option['+arrcnt+'][1]" placeholder="Answer Option 2" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 3</h4><input type="text" class="form-control" id="answer3" name="answer_option['+arrcnt+'][2]" placeholder="Answer Option 3" value=""></div>';
  html = html+'<div class="form-group col-sm-6"><h4 class="example-title">Option 4</h4><input type="text" class="form-control" id="answer4" name="answer_option['+arrcnt+'][3]" placeholder="Answer Option 4" value=""></div>';             
  html = html+'</div></div></div>';


                
  $("#survey_questions_div").html('<div id="more_questions"></div>');
  $("#more_questions").append(html);
 }
        </script>
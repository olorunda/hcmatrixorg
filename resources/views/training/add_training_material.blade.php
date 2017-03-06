@if(isset($id) && $id!='')  <?php $title = 'Edit Training Material'; ?> @else <?php $title = 'Add Training Material'; ?> @endif
@include('layouts.header', ['page_title' => $title])
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlc0lDbH_vAyXIw_gMUf-m6-yAQMKc8MQ&libraries=places"></script>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          <form class="form-horizontal" training_name="form" method="POST" action="@if(isset($id) && $id!='') {{ url('update-training-material') }} @else {{ url('add-training-material') }} @endif" enctype="multipart/form-data">
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-6">            
            <div class="col-xs-12">
              <div class="form-group">
                <?php //print_r($trainings); ?>
                <h4 class="example-title">Job Training Name</h4>
                <select class="form-control" id="training_id" name="training_id">
                  <option value = ''>Select</option>
                    @foreach($trainings as $training)  
                      @if($training->training_name!='' && $training->id!=0)
                        <option value = "{{ $training->id}}" {{ ((old("training_id")!='' && old("training_id") ==  $training->id) || (isset($training_materials) && $training_materials->training_id!='' && $training_materials->training_id ==  $training->id)) ? "selected=selected":"" }}>{{$training->training_name}}
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
              <div class="form-group">
                <h4 class="example-title">Pre / Post Reading</h4>
                <select class="form-control" id="reading_type" name="reading_type">
                  <option value = ''>Select</option>
                  <option value = "0" {{ ((old("reading_type")!='' && old("reading_type") ==  0) || (isset($training_materials) && $training_materials->reading_type ==  0)) ? "selected=selected" :"" }}>Pre Reading
                  </option>  
                  <option value = "1" {{ ((old("reading_type")!='' && old("reading_type") ==  1) || (isset($training_materials) && $training_materials->reading_type ==  1)) ? "selected=selected" :"" }}>Post Reading
                  </option>               
                  </select> 
              </div>  
              @if ($errors->has('reading_type'))
                <div class="flash-message">
                  <div class="alert alert-danger">
                    <strong>{{ $errors->first('reading_type') }}</strong>
                  </div>
                </div>
              @endif 
              <div class="form-group">
                <h4 class="example-title">Training Material Name</h4>
             
                <input type="text" class="form-control" id="training_material_name" name="training_material_name" placeholder="Training Material Name" value="{{ old('training_material_name')!='' ? old('training_material_name') : ((isset($training_materials) && $training_materials->training_material_name!='') ? $training_materials->training_material_name : '') }}">
              </div> 
              @if ($errors->has('training_material_name'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('training_material_name') }}</strong>
                      </div>
                    </div>
                  @endif

              <div class="form-group">
                <h4 class="example-title">Training Material</h4>
                  <input type="file" name="training_material" id="training_material">
                  @if(isset($training_materials) && $training_materials->training_material!='' && file_exists(public_path('uploads').'/'.$training_materials->training_material)) <a href="../public/uploads/<?php echo $training_materials->training_material; ?>" target="_blank">{{$training_materials->training_material}}</a> @endif

              </div> 
              @if ($errors->has('training_material'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('training_material') }}</strong>
                      </div>
                    </div>
                  @endif 
              

              
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding"><input type="submit" class="btn btn-primary waves-effect" value="@if(isset($id) && $id!='') {{ 'Update' }} @else {{ 'Save' }}@endif"></span>
                <span class="no-left-padding text-xs-left col-xs-3"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'training-material-list';"></span></div>
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
            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>
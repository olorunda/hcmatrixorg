<?php $title = 'Default Weekend Days'; ?>
@include('layouts.header', ['page_title' => $title])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          <div class="row row-lg col-xs-12"> 
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
          <form class="form-horizontal" role="form" method="POST" action="{{ url('update_weekend_days') }}">
            {{ csrf_field() }}     
                     
            <div class="col-xs-6">              
                <?php //print_r($roles); ?>
                <h4 class="example-title">Select the weekend days of a week</h4>
                @foreach($week_end_details as $week_end_det)  
                  <?php
                  $chked = '';
                  if($week_end_det->weekend_status==1)
                    $chked = "checked=checked";
                  ?>
                  <div class="form-group">
                    <div class="col-xs-1"><input type='checkbox' name='weekend_day[]' id='{{strtolower($week_end_det->weekend_day)}}_chk' {{$chked}} value='{{$week_end_det->weekend_day}}'></div><div class="col-xs-11"><label>{{$week_end_det->weekend_day}}</label> </div>  
                  </div>                    
                @endforeach                   
              
                @if ($errors->has('weekend_day'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('weekend_day') }}</strong>
                      </div>
                    </div>
                  @endif
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="submit" class="btn btn-primary waves-effect" id="training_btn" value="Save"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'edit-weekend_days';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>          
          </form>
          </div>
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
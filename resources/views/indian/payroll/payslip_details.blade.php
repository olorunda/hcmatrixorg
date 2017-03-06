<?php $title = 'Update Payslip Logo / Watermark'; ?>
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
        
          <form class="form-horizontal" role="form" method="POST" action="{{ url('update_payslip_details') }}" enctype="multipart/form-data">
            {{ csrf_field() }}     
                     
            <div class="col-xs-6">              
                <div class="form-group">
                  <h4 class="example-title">Logo <span class="required_filed">*</span></h4>
                  <input id="payslip_logo" class="form-control" name="payslip_logo" type="file">

                  @if(isset($payslip_details) && $payslip_details->payslip_logo!='' && file_exists(public_path('payslip_logo').'/'.$payslip_details->payslip_logo)) <br/><div id="payslip_logo_img"><img src="public/payslip_logo/<?php echo $payslip_details->payslip_logo; ?>" width="100" border="0"></div> @endif


                  
                  @if ($errors->has('payslip_logo'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('payslip_logo') }}</strong>
                      </div>
                    </div>
                  @endif 
              </div>
            <div class="form-group">
              <h4 class="example-title">Watermark Text <span class="required_filed">*</span></h4>
                <input id="watermark_text" class="form-control" name="watermark_text" type="text" placeholder="Watermark Text" value="{{ old('watermark_text')!='' ? old('watermark_text') : ((isset($payslip_details) && $payslip_details->watermark_text!='') ? $payslip_details->watermark_text : '') }}">
                 @if ($errors->has('watermark_text'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('watermark_text') }}</strong>
                      </div>
                    </div>
                  @endif 
            </div>  
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="submit" class="btn btn-primary waves-effect" id="training_btn" value="Save"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'edit-payslip-details';"></span></div>
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
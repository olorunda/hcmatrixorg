@include('layouts.header', ['page_title' => 'Dashboard'])
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-xxl-12 col-lg-12 col-xs-12">
          <!-- Widget Linearea Color -->
          <div class="card card-shadow card-responsive" id="widgetLineareaColor">
            <div class="card-block p-0">
              <div class="p-t-30 p-30" style="height:calc(100% - 250px);">
                <div class="row">
                  
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

                  <div class="col-xs-12">
                    <p class="font-size-20 blue-grey-700">Welcome to HCMatrix!!!</p>                   
                  </div>                
                </div>
              </div>
            </div>
          </div>
          <!-- End Widget Linearea Color -->
        </div>
        
        
        
        
        
        
        
        
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  @include('layouts.footer')
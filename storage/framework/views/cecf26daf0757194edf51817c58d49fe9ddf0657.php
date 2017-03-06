<?php echo $__env->make('layouts.header', ['page_title' => 'Employee Hirerachy'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Employee Hirerachy</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
            
      
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div id="chart-container"></div>  
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
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script type="text/javascript">

  function initOrgchart(rootClass,data_src) {
    $('#chart-container').orgchart({
      'chartClass': rootClass,
      'data' : data_src,
      'nodeContent': 'title',
      'createNode': function($node, data) {
        if ($node.is('.drill-down')) {
          var assoClass = data.className.match(/asso-\w+/)[0];
          var drillDownIcon = $('<i>', {
            'class': 'fa fa-arrow-circle-down drill-icon',
            'click': function() {
              $('#chart-container').find('.orgchart:visible').addClass('chart_hidden');
                    if (!$('#chart-container').find('.orgchart.' + assoClass).length) {
                      initOrgchart(assoClass,data_src.emp_array);
                    } else {
                      $('#chart-container').find('.orgchart.' + assoClass).removeClass('chart_hidden');
                    }
            }
          });
          $node.append(drillDownIcon);
        } else if ($node.is('.drill-up')) {
          var assoClass = data.className.match(/asso-\w+/)[0];
          var drillUpIcon = $('<i>', {
            'class': 'fa fa-arrow-circle-up drill-icon',
            'click': function() {
              $('#chart-container').find('.orgchart:visible').addClass('chart_hidden').end()
                .find('.drill-down.' + assoClass).closest('.orgchart').removeClass('chart_hidden');
            }
          });
          $node.append(drillUpIcon);
        }
      }
    });
  }

  $(window).load(function() {
    $.ajax({
        type: "GET",
        url: "emp_hierarchy_json",
        dataType: "json", 
        
          success: function(response){ 
            $('#chart-container').orgchart({
              'data' : response.result_array,
              'depth': 2,
              'nodeContent': 'title',
              'createNode': function($node, data) {

                if ($node.is('.drill-down')) {
                var assoClass = data.className.match(/asso-\w+/)[0];
                var drillDownIcon = $('<i>', {
                  'class': 'fa fa-arrow-circle-down drill-icon',
                  'click': function() {                    
                    $('#chart-container').find('.orgchart:visible').addClass('chart_hidden');
                    if (!$('#chart-container').find('.orgchart.' + assoClass).length) {
                      initOrgchart(assoClass,data.emp_array);
                    } else {
                      $('#chart-container').find('.orgchart.' + assoClass).removeClass('chart_hidden');
                    }
                  }
                });
                $node.append(drillDownIcon);
              } else if ($node.is('.drill-up')) {
                var assoClass = data.className.match(/asso-\w+/)[0];
                var drillUpIcon = $('<i>', {
                  'class': 'fa fa-arrow-circle-up drill-icon',
                  'click': function() {
                    $('#chart-container').find('.orgchart:visible').addClass('chart_hidden').end()
                      .find('.drill-down.' + assoClass).closest('.orgchart').removeClass('chart_hidden');
                  }
                });
                $node.append(drillUpIcon);
              }

                /*if(data.people_mgr_id && data.emp_array)
                {                  
                  var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon',
                    click: function() {
                      console.log(data.emp_array);
                      $('#people_mgr_name').html(data.name);
                      $('#ppl_mgr_container').html('');
                         $('#ppl_mgr_container').orgchart({

                          'data' : data.emp_array,
                          'depth': 2,
                          'nodeContent': 'title'
                        });
                        $("#modal-people_manager_hierarchy").modal('show'); 
                      
                    }
                  });  
                  $node.append(secondMenuIcon);          
                }*/
      }
            });

    

          
        }     
      });
  });

  /*$(window).load(function()
  {
    initOrgchart('root-node');
  });

  $(window).load(function() {
    $.ajax({
        type: "GET",
        url: "emp_hierarchy_json",
        dataType: "json", 
        
          success: function(response){ 
            $('#chart-container').orgchart({
              'data' : response.result_array,
              'depth': 2,
              'nodeContent': 'title',
              'createNode': function($node, data) {
                if(data.people_mgr_id && data.emp_array)
                {                  
                  var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon',
                    click: function() {
                      console.log(data.emp_array);
                      $('#people_mgr_name').html(data.name);
                      $('#ppl_mgr_container').html('');
                         $('#ppl_mgr_container').orgchart({

                          'data' : data.emp_array,
                          'depth': 2,
                          'nodeContent': 'title'
                        });
                        $("#modal-people_manager_hierarchy").modal('show'); 
                      
                    }
                  });  
                  $node.append(secondMenuIcon);          
                }
      }
            });

    

          
        }     
      });
  });*/



  /*  $('#chart-container').orgchart({
  'data' : <?php echo $employees_arr; ?>,
  'depth': 2,
  'nodeTitle': 'name',
  'nodeContent': 'title'
});
    

      
      
      
    $('#chart-container').orgchart({
      'data' : <?php echo $employees_arr; ?>,
      'depth': 2,
      'nodeContent': 'title'
    });
  });*/

 function fnSubmit(arg)
    {
      $("#employee_num").val(arg);
       $("#update_form").submit();
    }

  </script>
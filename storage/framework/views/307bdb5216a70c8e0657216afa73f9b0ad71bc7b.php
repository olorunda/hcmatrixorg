<?php if(is_active('lm/*')): ?>
<?php    $id=$employee->id; ?>
<?php else: ?>
<?php    $id=\Auth::user()->id; ?>
<?php endif; ?>
 $.get('/employeet/pilotchart/<?php echo e($id); ?>',function(data,status,xhr){
 linkinfo= Morris.Bar({
  element: 'pilotchart',
  data: data,
   barGap:1,
  barSizeRatio:0.2,
  xkey: 'y',
  ykeys: ['a', 'b'],
  barColors: ['#cddc39','#4caf50'],

  labels: ['LM-Rating', 'HR-Rating']
});
 
       });
	   
	      });




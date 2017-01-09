@if(is_active('lm/*'))
<?php    $id=$employee->id; ?>
@else
<?php    $id=\Auth::user()->id; ?>
@endif
 $.get('/employeet/pilotchart/{{$id}}',function(data,status,xhr){
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




<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jquery.orgchart.css')); ?>">
<style type="text/css">
	.orgchart {
		background: #fff; 
	}
	.orgchart td.left, .orgchart td.right, .orgchart td.top {
		border-color: #aaa;
	}
	.orgchart td>.down {
		background-color: #aaa;
	}
	.orgchart .middle-level .title {
		background-color: #006699;
	}
	.orgchart .middle-level .content {
		border-color: #006699;
	}
	.orgchart .product-dept .title {
		background-color: #009933;
	}
	.orgchart .product-dept .content {
		border-color: #009933;
	}
	.orgchart .rd-dept .title {
		background-color: #993366;
	}
	.orgchart .rd-dept .content {
		border-color: #993366;
	}
	.orgchart .pipeline1 .title {
		background-color: #996633;
	}
	.orgchart .pipeline1 .content {
		border-color: #996633;
	}
	.orgchart .frontend1 .title {
		background-color: #cc0066;
	}
	.orgchart .frontend1 .content {
		border-color: #cc0066;
	}
	#chart-container {
		position: relative;
		display: inline-block;
		top: 10px;
		left: 10px;
		height: 420px;
		width: calc(100% - 24px);
		border: 2px dashed #aaa;
		border-radius: 5px;
		overflow: auto;
		text-align: center;
	}
</style>
<script type="text/javascript">
	'use strict';

	(function($){

		/*$(function() {
			
			var datascource = {
				'name': 'Lao Lao',
				'title': 'general manager',
				'children': [
					{ 'name': 'Bo Miao', 'title': 'department manager', 'className': 'middle-level'},
					{ 'name': 'Su Miao', 'title': 'department manager', 'className': 'middle-level'}
				]
			};

			$('#chart-container').orgchart({
				'data' : datascource,
				'nodeContent': 'title'
			});
		});*/

	})(jQuery);
</script>
<script type="text/javascript">

	function loadGraph(id, name, title)
	{

		$('#chartcontainer'+id).orgchart({
			'data' : '<?php echo e(url('lm/org')); ?>?id='+id,
			'nodeTitle': 'name',
			'nodeContent': 'title'

		});

	}
</script>

<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="panel panel-bordered">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-cogs"></i> Direct Reports</h4>
			</div>
			<div class="panel-body" style="overflow: auto;">
				<?php if(isset($direct)): ?>

				<div id="chartcontainer<?php echo e($direct->id); ?>"></div>
				<button type="button" class="btn btn-icon btn-dark btn-outline btn-round" onclick="loadGraph('<?php echo e($direct->id); ?>', '<?php echo e($direct->name); ?>', '<?php echo e($job['title']); ?>')">
					<i class="fa fa-cogs" aria-hidden="true"></i>
				</button>
				<div id="orga<?php echo e($direct->id); ?>" style="display:none;"></div>

				<?php else: ?>

				<div id="chartcontainer<?php echo e(Auth::user()->id); ?>"></div>
				<button type="button" class="btn btn-icon btn-dark btn-outline btn-round" onclick="loadGraph('<?php echo e(Auth::user()->id); ?>', '<?php echo e(Auth::user()->name); ?>', '<?php echo e($job['title']); ?>')">
					<i class="fa fa-cogs" aria-hidden="true"></i>
				</button>
				<div id="orga<?php echo e(Auth::user()->id); ?>" style="display:none;"></div>

				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.orgchart.js')); ?>"></script>
@extends('layouts.appd')

@section('content')
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id); ?>
<?php
function countsex(array $directemps, $sex) 
{
	$count = 0;
	for($i = 0; $i < count($directemps); $i++)
	{
		if($directemps[$i]==$sex)
		{
			$count+=1;
		}
	}
	return $count;
}
?>
<script>
function search1(){
	
	

  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchfield");
  filter = input.value.toUpperCase();
  table = document.getElementById("directempstable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }

	
}

	function url(url){
		window.location=url;
	}
</script>

<div class="page bg-white">
	<div class="page-aside">
		<!-- Contacts Sidebar -->
		<div class="page-aside-switch">
			<i class="icon wb-chevron-left" aria-hidden="true"></i>
			<i class="icon wb-chevron-right" aria-hidden="true"></i>
		</div>
		<div class="page-aside-inner page-aside-scroll">
			<div data-role="container">
				<div data-role="content">
					<?php
					$direct = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'all');
					$data[] = '';
					foreach($direct as $emps){$data[]=$emps->sex;}
					?>
					<div class="page-aside-section">
						<div class="list-group">
							<a class="list-group-item" href="javascript:void(0)" onclick="cat('A')">
								<span class="item-right">{{count($direct)}}</span><i class="icon wb-inbox" aria-hidden="true"></i>Direct Reports
							</a>
						</div>
					</div>
					<div class="page-aside-section">
						<h5 class="page-aside-title">LABEL</h5>
						<div class="page-aside-section">
							<input type="hidden" name="lmtoken" id="lmtoken" value="{{csrf_token()}}">
							<div class="list-group" style="margin-bottom: 1px;">
								<h5>
									<a class="list-group-item " href="javascript:void(0)" onclick="cat('M');">
										<span class="item-right">{{countsex($data, 'M')}}</span><i class="fa fa-male" aria-hidden="true"></i> Male
									</a>
								</h5>
							</div>
							<div class="list-group">
								<h5>
									<a class="list-group-item " href="javascript:void(0)" onclick="cat('F');">
										<span class="item-right">{{countsex($data, 'F')}}</span><i class="fa fa-female" aria-hidden="true"></i> Female
									</a>
								</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Employee Table Content -->
	<div class="page-main">
		<!-- Employee Table Content Header -->
		<div class="page-header">
			<h1 class="page-title">Direct Reports</h1>
			<div class="page-header-actions">
				
					<div class="input-search input-search-dark">
						<i class="input-search-icon wb-search" aria-hidden="true"></i>
						<input type="text" class="form-control" name="searchfield" id="searchfield" onkeyup="search1()" placeholder="Search: Employee name...">
					</div>
			
			</div>
		</div>
		<!-- Employee Table Content -->
		<div id="contactsContent" class="page-content page-content-table" data-plugin="asSelectable">
			<!-- Actions -->
			<div class="page-content-actions">
			</div>
			<!-- Employees Table -->
			<table class="table table-condensed" id="directempstable">
				<thead class="thead-warning">
					<tr style="font-size: 14px;">
						<th>
							Sex
						</th>
						<th>Name</th>
						<th>Employee ID</th>
						<th>Job Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="directempsbody">
					@if(count($directemps) > 0)
					@foreach($directemps as $emp)
					<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($emp->job_id); ?>
					<tr>
						<td height="10">
							@if($emp->sex=='M')
							<h4><i class="fa fa-male"></i></h4>
							@else
							<h4><i class="fa fa-female"></i></h4>
							@endif
						</td>
						<td height="10">
							<img class="img-circle img-bordered img-bordered-primary" alt="avatar" src="{{asset($emp->image)}}" style="width: 50px;height: 50px;">
							{{$emp->name}}
						</td>
						<td height="10">{{$emp->emp_num}}</td>
						<td height="10">{{$job['title']}}</td>
						<td height="10">
							<button type="button" class="btn btn-floating btn-success btn-sm" title="L.M. Goal" onclick="url('/lm/objectives_a?isemp={{$emp->id}}')">
								<i class="icon wb-pencil" aria-hidden="true"></i>
							</button>
							<button type="button" class="btn btn-floating btn-danger btn-sm" title="Rate Employee" onclick="url('/lm/rate?isemp={{$emp->id}}')">
								<i class="icon wb-star" aria-hidden="true"></i>
							</button>
						</td>
					</tr>
					@endforeach
					<tr>
						<th colspan="5">{{ $directemps->links() }}</th>
					</tr>
					@else
					<tr>
						<th colspan="5">
							<h3>No Direct Employees Assigned To You Yet.</h3>
						</th>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<a class="btn btn-primary btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="No match found." data-title="Search Box" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>
</div>
@endsection
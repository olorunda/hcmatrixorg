<?php

namespace App\Http\Controllers;

use Crypt;

use Illuminate\Http\Request;

class AvailJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($id == 'joblist')
        {
            $states = app('App\Repositories\JobRepository')->getLocations('all');
            $jobs = app('App\Repositories\JobRepository')->getJobs('all');
            $joblevels = app('App\Repositories\JobRepository')->getJobLevel('all');
            $jobtypes  = app('App\Repositories\JobRepository')->getJobTypes('all');
            $jobdepts   = app('App\Repositories\JobRepository')->getJobDept('all');
            return view('jobs.joblisting', ['states'=>$states, 'jobs'=>$jobs, 'joblevels'=>$joblevels, 'jobtypes'=>$jobtypes, 'jobdepts'=>$jobdepts, 'results'=>[]]);
        }
        elseif($id == 'jobs')
        {
            $id = $request->id;
            $jobInfo = $this->getJob($id);
            $joblevels = app('App\Repositories\JobRepository')->getJobLevel('all');
            $jobtypes  = app('App\Repositories\JobRepository')->getJobTypes('all');
            $jobdepts   = app('App\Repositories\JobRepository')->getJobDept('all');
            $states = app('App\Repositories\JobRepository')->getLocations('all');

            return view('jobs.job', ['jobid'=>$id, 'states'=>$states, 'jobDetail'=>$jobInfo, 'joblevels'=>$joblevels, 'jobtypes'=>$jobtypes, 'jobdepts'=>$jobdepts]);
        }
        elseif($id == 'default')
        {
            session(['preview_job'=>1]);
            $id         = $request->job_id;
            $states     = app('App\Repositories\JobRepository')->getLocations('all');
            $countries  = app('App\Repositories\JobRepository')->getCountries('all');
            return view('jobs.default', ['states'=>$states, 'countries'=>$countries, 'jobid'=>$id]);
        }
		elseif($id=='applied'){
			
			if(\Auth::guest()){
				return redirect('login');
			}
			$getaplliedjobs=app('App\Repositories\JobRepository')->getappliedjobs();
			return view('jobs.appliedfor',['appliedfor'=>$getaplliedjobs]);
		}
        /*elseif($id == 'filter')
        {
            $experience         = $request->experience;
            $jobtype            = $request->jobtype;
            $emptype            = $request->emptype;
            $deptfil            = $request->deptfil;
            $dateposted         = $request->dateposted;
            $location           = $request->location;

            $states = app('App\Repositories\JobRepository')->getLocations('all');
            $jobs = app('App\Repositories\JobRepository')->getJobs('all');
            $joblevels = app('App\Repositories\JobRepository')->getJobLevel('all');
            $jobtypes  = app('App\Repositories\JobRepository')->getJobTypes('all');
            $jobdepts   = app('App\Repositories\JobRepository')->getJobDept('all');

            $result = app('App\Repositories\JobRepository')->jobFilter($experience, $jobtype, $emptype, $deptfil, $dateposted, $location);
            return $result;
            return view('jobs.joblisting', ['states'=>$states, 'jobs'=>$jobs, 'joblevels'=>$joblevels, 'jobtypes'=>$jobtypes, 'jobdepts'=>$jobdepts, 'results'=>$result]);
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getJob($id)
    {
        return app('App\Repositories\JobRepository')->getJobs($id);
    }

    public function getLocation($id)
    {
        $retVal = app('App\Repositories\JobRepository')->getLocation($id);
        if(count($retVal) <= 0)
        {
         $retVal['state'] = "Not Found!";
     }
     return $retVal;
 }

 public function getDept($id)
 {
    $retVal = app('App\Repositories\JobRepository')->getDepartment($id);
    if(!$retVal || count($retVal) <= 0)
    {
     $retVal['spec'] = "No Department Found";
 }
 return $retVal['spec'];
}

public function getJobLevel($id)
{
	
    $retVal = app('App\Repositories\JobRepository')->getLevel($id);
    if(!$retVal || count($retVal) <= 0)
    {
     $retVal['level'] = "No Level Found";
 
    }
 return $retVal;
}

public function getJobType($id)
{
    $retVal = app('App\Repositories\JobRepository')->getJobType($id);
    if(count($retVal) <= 0)
    {
     $retVal['work_type'] = "No Work Type Found";
 }
 return $retVal;
}

public function jobFilter($experience, $jobtype, $emptype, $deptfil, $dateposted, $location)
{
            /*$experience         = $request->experience;
            $jobtype            = $request->jobtype;
            $emptype            = $request->emptype;
            $deptfil            = $request->deptfil;
            $dateposted         = $request->dateposted;
            $location           = $request->location;*/

            $states = app('App\Repositories\JobRepository')->getLocations('all');
            $jobs = app('App\Repositories\JobRepository')->getJobs('all');
            $joblevels = app('App\Repositories\JobRepository')->getJobLevel('all');
            $jobtypes  = app('App\Repositories\JobRepository')->getJobTypes('all');
            $jobdepts   = app('App\Repositories\JobRepository')->getJobDept('all');

            $result = app('App\Repositories\JobRepository')->jobFilter($experience, $jobtype, $emptype, $deptfil, $dateposted, $location);
            return view('jobs.joblisting', ['states'=>$states, 'jobs'=>$jobs, 'joblevels'=>$joblevels, 'jobtypes'=>$jobtypes, 'jobdepts'=>$jobdepts, 'results'=>$result]);
        }
    }

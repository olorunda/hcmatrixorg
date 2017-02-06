<?php

namespace App\Http\Middleware;

use Closure;

class routerights
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		app('App\Http\Controllers\MicrosoftController')->refresh_token();
			 
		if(\Auth::user()->superadmin==0){
		$getrights=app('App\Http\Controllers\GlobalsettingController')->getsetting2(\Auth::user()->id);
		
		\Session::flash('query',$getrights['query']);	
		\Session::flash('record',$getrights['record']);	
		\Session::flash('record',$getrights['record']);	
		
			//attendance management right
			if($request->is('manage/absence','leave','sort/*','search','manage/leavestat','hr/attendance')){
				if($getrights['attendance']==1){
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');
			}
			}
			
			//record management rights
			if($request->is('view/docadmin','edit/folder','savefolder')){
				
				if($getrights['record']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}
			//global settings right
				if($request->is('hr/settings','hr/jobdepsettings','hr/deletejob','hr/manualadd','hr/getdep','hr/importjob')){
				
				if($getrights['settings']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}
			
			//goal management right
				if($request->is('employee/objective','lm/goals','lm/objectives_c','lm/rate','lm/objectives_a')){
				
				if($getrights['goal']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}
			//talent management right
				if($request->is('manage/positions','applicant/job','savelisting/type','employee/uploadapptitude','test/setting','import/question','deletequestion/*','updatequestion')){
				
				if($getrights['talent']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}
			
			//executive view right
			if($request->is('hr/executiveview')){
				
				if($getrights['execview']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}	
			
			
			//query management rights
			if($request->is('lm/query')){
				
				if($getrights['query']==1){
					
					
				}
				else{
					if($request->ajax()){
						return response()->json('Unauthorized',401);
					}
				return redirect('/error');	
				}
				
			}
			
			
			
			
			
		}
			
		 
        return $next($request);
    }
}

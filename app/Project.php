<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
	protected $dates=['start_date','end_est_date','actual_ending_date'];
	
	protected $fillable=['name','code','start_date','end_est_date','actual_ending_date','assigned_to_id','remark','client_id'];
	 
}

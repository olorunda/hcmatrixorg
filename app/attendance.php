<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    //
	protected $fillable=['user_id','clockout_time'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class query extends Model
{
	protected $fillable=['query_type_id', 'user_id', 'lm_id','document', 'status', 'new', 'empnew', 'lmnew', 'content'];

 //
}

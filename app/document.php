<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    //
	protected $fillable = ['document', 'type_id', 'user_id'];
}

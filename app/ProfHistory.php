<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfHistory extends Model
{
    //
    protected $fillable = ['user_id', 'body', 'date_joined', 'till', 'mode', 'prof_number', 'certificate'];
}

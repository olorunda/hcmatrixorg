<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $fillable = ['user_id', 'name', 'start_year', 'end_year', 'degree'];
}

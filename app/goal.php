<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //
    protected $fillable = ['objective', 'commitment', 'emp_id', 'assigned_to', 'goal_cat'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    protected $fillable=['title','description','jobdep_id'];
}

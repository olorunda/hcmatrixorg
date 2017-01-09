<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = ['user_id', 'street', 'city', 'lga', 'state_id', 'state_origin_id', 'id'];
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'emp_num', 'sex', 'dob', 'age', 'phone_num', 'marital_status', 'workdept_id', 'job_id', 'hiredate', 'role', 'EDLEVEL', 'image', 'last_promoted', 'address', 'next_of_kin', 'kin_address', 'kin_phonenum', 'kin_relationship', 'twitter', 'facebook', 'dribble', 'instagram', 'linemanager_id', 'job_app_id','state_origin_id', 'lga', 'job_reg_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

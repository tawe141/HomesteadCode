<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = ['user_id'];

    public function users() {
        return $this->hasMany('App/User');
    }
}

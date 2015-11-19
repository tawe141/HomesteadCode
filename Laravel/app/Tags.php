<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name'];
    public function data() {
        return $this->belongsToMany('App\Data', 'data_tag');
    }

}

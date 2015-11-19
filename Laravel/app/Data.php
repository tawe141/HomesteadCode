<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'idnum', 'jobtitle', 'user_id'
    ];

    public function author() {
        return $this->belongsTo('App\User');
    }
    public function tags() {
        return $this->belongsToMany('App\Tags', 'data_tag')->withTimestamps();
    }
    public function getTagListAttribute() {
        return $this->tags->lists('id');
    }
}

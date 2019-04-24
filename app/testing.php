<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testing extends Model
{
    protected $table = "testing";
    protected $fillable =['bug_id','url_id','complete'];
    const UPDATED_AT = null;
    const CREATED_AT =null;

    public function bug(){
        return $this->belongsTo('App\bug');
    }

    public function url(){
        return $this->belongsTo('App\url');
    }

    public function t_bugs(){
        return $this->hasMany('App\t_bug');
    }
}

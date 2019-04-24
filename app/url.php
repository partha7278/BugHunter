<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    protected $table = "url";
    const UPDATED_AT = null;
    protected $fillable =['pid','created_at','project_url'];

    public function project(){
        return $this->belongsTo('App\project');
    }
    public function testings(){
        return $this->hasMany('App\testing');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_bug extends Model
{
    protected $table = "t_bug";
    protected $fillable = ['created_at','testing_id','vulnerable_url','send'];
    const UPDATED_AT = null;

    public function testing(){
        return $this->belongsTo('App\testing');
    }
}

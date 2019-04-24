<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $table = "project";
    protected $fillable =['project_name','created_at','contact'];
    const UPDATED_AT = null;

    public function urls(){
        return $this->hasMany('App\url');
    }
}
